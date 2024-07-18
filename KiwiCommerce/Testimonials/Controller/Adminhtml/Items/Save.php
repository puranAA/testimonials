<?php
namespace KiwiCommerce\Testimonials\Controller\Adminhtml\Items;

class Save extends \KiwiCommerce\Testimonials\Controller\Adminhtml\Items
{
    public function execute()
    {
        if ($this->getRequest()->getPostValue()) {
            try {
                $model = $this->testimonialFactory->create();
                $data = $this->getRequest()->getPostValue();
                if(isset($_FILES['profile_pic']['name']) && $_FILES['profile_pic']['name'] != '') {
                    try{
                        $uploaderFactory = $this->uploaderFactory->create(['fileId' => 'profile_pic']);
                        $uploaderFactory->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                        $uploaderFactory->setAllowRenameFiles(true);
                        $uploaderFactory->setFilesDispersion(true);
                        $mediaDirectory = $this->filesystem->getDirectoryRead($this->directoryList::MEDIA);
                        $destinationPath = $mediaDirectory->getAbsolutePath('kiwicommerce/testimonials');
                        $result = $uploaderFactory->save($destinationPath);
                        if (!$result) {
                            throw new LocalizedException(
                                __('File cannot be saved to path: $1', $destinationPath)
                            );
                        }
                        
                        $imagePath = 'kiwicommerce/testimonials'.$result['file'];
                        $data['profile_pic'] = $imagePath;
                    } catch (\Exception $e) {
                    }
                }
                if(isset($data['profile_pic']['delete']) && $data['profile_pic']['delete'] == 1) {
                    $mediaDirectory = $this->filesystem->getDirectoryRead($this->directoryList::MEDIA)->getAbsolutePath();
                    $file = $data['profile_pic']['value'];
                    $imgPath = $mediaDirectory.$file;
                    if ($this->_file->isExists($imgPath))  {
                        $this->_file->deleteFile($imgPath);
                    }
                    $data['profile_pic'] = '';
                }
                if (isset($data['profile_pic']['value'])){
                    $data['profile_pic'] = $data['profile_pic']['value'];
                }
                $id = $this->getRequest()->getParam('id');
                if ($id) {
                    $model->load($id);
                    if ($id != $model->getId()) {
                        throw new \Magento\Framework\Exception\LocalizedException(__('The wrong item is specified.'));
                    }
                }
                $model->setData($data);
                $session = $this->adminSession;
                $session->setPageData($model->getData());
                $model->save();
                $this->messageManager->addSuccess(__('You saved the testimonial.'));
                $session->setPageData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('kiwi_commerce_testimonials/*/edit', ['id' => $model->getId()]);
                    return;
                }
                $this->_redirect('kiwi_commerce_testimonials/*/');
                return;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
                $id = (int)$this->getRequest()->getParam('id');
                if (!empty($id)) {
                    $this->_redirect('kiwi_commerce_testimonials/*/edit', ['id' => $id]);
                } else {
                    $this->_redirect('kiwi_commerce_testimonials/*/new');
                }
                return;
            } catch (\Exception $e) {
                $this->messageManager->addError(
                    __('Something went wrong while saving the item data. Please review the error log.')
                );
                $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
                $session = $this->adminSession;
                $session->setPageData($data);
                $this->_redirect('kiwi_commerce_testimonials/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                return;
            }
        }
        $this->_redirect('kiwi_commerce_testimonials/*/');
    }
}
