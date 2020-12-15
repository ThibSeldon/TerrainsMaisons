<?php


namespace App\Service;


use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    private $targetDirectory;
    private $slugger;
    private $filesystem;
    private $picturesDirectory;

    public function __construct($targetDirectory, $picturesDirectory, SluggerInterface $slugger, Filesystem $filesystem)
    {
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
        $this->filesystem = $filesystem;
        $this->picturesDirectory = $picturesDirectory;
    }

    public function upload(UploadedFile $file): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid('', true).'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }

    public function delete(string $filename = null):void
    {
        if($filename) {
            $fullFileName = $this->getTargetDirectory() . '/' . $filename;
            $this->getFilesystem()->remove($fullFileName);
        }

    }

    public function uploadPicture(UploadedFile $file): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid('', true).'.'.$file->guessExtension();

        try {
            $file->move($this->getPictureDirectory(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }

    public function deletePicture(string $filename = null):void
    {
        if($filename) {
            $fullFileName = $this->getPictureDirectory() . '/' . $filename;
            $this->getFilesystem()->remove($fullFileName);
        }

    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
    public function getPictureDirectory()
    {
        return $this->picturesDirectory;
    }
    public function getFilesystem()
    {
        return $this->filesystem;
    }


}