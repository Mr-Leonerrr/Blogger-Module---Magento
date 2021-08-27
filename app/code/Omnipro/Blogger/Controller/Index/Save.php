<?php

namespace Omnipro\Blogger\Controller\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\View\FileSystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Omnipro\Blogger\Model\Post;

class Submit extends Action
{

    /** @var Post */
    protected $_resultFactory;

    /** @var UploaderFactory */
    protected $_uploaderFactory;

    /** @var AdapterFactory */
    protected $_adapterFactory;

    /** @var FileSystem */
    protected $_fileSystem;

    public function __construct(Context $context, Post $resultFactory, UploaderFactory $uploaderFactory, AdapterFactory $adapterFactory, FileSystem $fileSystem)
    {
        $this->_resultFactory = $resultFactory;
        $this->_uploaderFactory = $uploaderFactory;
        $this->_adapterFactory = $adapterFactory;
        $this->_fileSystem = $fileSystem;
        parent::__construct($context);
    }

    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->resultRedirectFactory->create()->setPath("*/*/");
        }
        $post = $this->validateParams();
        if (isset($_FILES["image"]["name"]) && $_FILES["image"]["name"] !== "") {
            try {
                $uploaderFactory = $this->_uploaderFactory->create(["fileId" => "image"]);
                $uploaderFactory->setAllowedExtensions(["jpg", "jpeg", "png"]);
                $imageAdapter = $this->_adapterFactory->create();
                $uploaderFactory->addValidateCallback("post_image_url", $imageAdapter, "validateUploadFile");
                $uploaderFactory->setAllowRenameFiles(true);
                $uploaderFactory->setFilesDispersion(true);
                $mediaDir = $this->_fileSystem->getDirectoryRead(DirectoryList::MEDIA);
                $destinationPath = $mediaDir->getAbsolutePath("omnipro/blogger");
                $result = $uploaderFactory->save($destinationPath);
                print_r($result);
                if (!$result) {
                    throw new LocalizedException(__("Image can't be saved to path: $1", $destinationPath));
                }

                $imagePath = "omnipro/blogger" . $result['file'];
                $post["image"] = $imagePath;
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
        $postForm = $this->_resultFactory->create();
        $postForm->setData($post);
        if ($postForm->save()) {
            $this->messageManager->addSuccessMessage(__("Your history has been published!"));
        } else {
            $this->messageManager->addErrorMessage(__('Your history was rejected ):'));
        }
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setUrl("blogger");
        return $redirect;
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function validateParams() {
        $request = $this->getRequest();
        if(trim($request->getParam('post_title')) === "") {
            throw new LocalizedException(__("🎃 Enter the title of your history!"));
        }
        if(trim($request->getParam("post_content")) === "") {
            throw new LocalizedException(__("🔮 Hey, tell us your history!"));
        }
        if(trim($request->getParam('post_content')) === "" && trim($request->getParam("image_url")) === "") {
            throw new LocalizedException(__("🚀 Hey, we need you to tell us your story and show us a photo!"));
        }
        if(false === \strpos($request->getParam("author_email"), "@")) {
            throw new LocalizedException(__("🛑 The email is invalid. Verify the email address and try again."));
        }
        if(trim($request->getParam("author_email")) === "") {
            throw new LocalizedException(__("🐱‍👤 You can't stay incognito here."));
        }
        return $request->getParams();
    }
}
