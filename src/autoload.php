<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
spl_autoload_register(
    function($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'example\\company' => '/Company.php',
                'example\\container' => '/Container.php',
                'example\\containerid' => '/ContainerId.php',
                'example\\duplicatepurposeportexception' => '/exceptions/DuplicatePurposePortException.php',
                'example\\exception' => '/exceptions/Exception.php',
                'example\\invalidcapacityexception' => '/exceptions/InvalidCapacityException.php',
                'example\\invalidcontaineridexception' => '/exceptions/InvalidContainerIdException.php',
                'example\\invalidlatitudeexception' => '/exceptions/InvalidLatitudeException.php',
                'example\\invalidlongitudeexception' => '/exceptions/InvalidLongitudeException.php',
                'example\\invalidnameexception' => '/exceptions/InvalidNameException.php',
                'example\\lastpurposeportremoveexception' => '/exceptions/LastPurposePortRemoveException.php',
                'example\\logisticssoft' => '/LogisticsSoft.php',
                'example\\noshipwasfoundexception' => '/exceptions/NoShipWasFoundException.php',
                'example\\port' => '/Port.php',
                'example\\position' => '/Position.php',
                'example\\ship' => '/Ship.php',
                'example\\shipcontainerlink' => '/ShipContainerLink.php'
            );
        }
        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    },
    true,
    false
);
// @codeCoverageIgnoreEnd
