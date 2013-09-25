<?php
/**
 * Coolcsn Zend Framework 2 File Manager Module
 *
 * @link https://github.com/coolcsn/CsnFileManager for the canonical source repository
 * @copyright Copyright (c) 2005-2013 LightSoft 2005 Ltd. Bulgaria
 * @license https://github.com/coolcsn/CsnFileManager/blob/master/LICENSE BSDLicense
 * @author Stoyan Cheresharov <stoyan@coolcsn.com>
 * @author Stoyan Revov <st.revov@gmail.com>
*/

// File: UploadForm.php // File Post-Redirect-Get Plugin
namespace CsnFileManager\Form;

use Zend\InputFilter;
use Zend\Form\Element;
use Zend\Form\Form;

class UploadForm extends Form
{

	protected $_dir;
	protected $serviceLocator;

    public function __construct($serviceLocator, $dir, $name = null, $options = array())
    {
        parent::__construct($name, $options);
		$this->serviceLocator = $serviceLocator;
		$this->_dir = $dir;
		
		$this->setAttribute('enctype','multipart/form-data');
        $this->addElements();
        $this->addInputFilter();
    }

    public function addElements()
    {
        // File Input
        $file = new Element\File('image-file');
        $file->setLabel('Image Upload')
             ->setAttribute('id', 'image-file')
             ->setAttribute('multiple', true);   // That's it
        $this->add($file);
		
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Upload',
                'id' => 'submitbutton',
            ),
        ));
    }

	/**
	 * Adding a RenameUpload filter to our form’s file input, with details on where the valid files should be stored
	 */
    public function addInputFilter()
    {
        $inputFilter = new InputFilter\InputFilter();

        // File Input
        $fileInput = new InputFilter\FileInput('image-file');
        $fileInput->setRequired(true);

		$maxSize = $this->serviceLocator->get('Config')['file_manager']['maxSize'];
		
        // You only need to define validators and filters
        // as if only one file was being uploaded. All files
        // will be run through the same validators and filters
        // automatically.
        $fileInput->getValidatorChain()
            ->attachByName('filesize',      array('max' => $maxSize))
            ->attachByName('filemimetype',  array('mimeType' => 'image/png, image/x-png, image/jpeg'));
//          ->attachByName('fileimagesize', array('maxWidth' => 100, 'maxHeight' => 100));

        // All files will be renamed, i.e.:
        //   ./data/tmpuploads/avatar_4b3403665fea6.png
        $fileInput->getFilterChain()->attachByName(
            'filerenameupload',
            array(
                'target'    => $this->_dir, // './data/tmpuploads/avatar.png',
                'randomize' => true,
            )
        );
        $inputFilter->add($fileInput);

        $this->setInputFilter($inputFilter);
    }
}