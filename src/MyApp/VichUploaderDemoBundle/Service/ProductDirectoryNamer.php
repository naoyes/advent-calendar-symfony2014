<?php

namespace MyApp\VichUploaderDemoBundle\Service;

use Symfony\Component\Validator\Constraints\DateTime;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\DirectoryNamerInterface;

class ProductDirectoryNamer implements DirectoryNamerInterface
{
    public function directoryName($object, PropertyMapping $mapping)
    {
        return (new \DateTime())->format('Y/m/d');
    }

}
