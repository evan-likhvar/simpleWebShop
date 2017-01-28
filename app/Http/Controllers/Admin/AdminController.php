<?php

namespace App\Http\Controllers\Admin;

use App\Parameter_group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    protected  $parameterGroups;

    public function __construct()
    {
        $this->middleware('auth');
        $this->parameterGroups = Parameter_group::all();
    }

    public function mainIndex()
    {
        $parGrp = $this->parameterGroups;
        return view('admin.adminapp')->with(compact('parGrp'));
    }
//это НЕ галерея, а привьюши картинки!!!!
    protected function createImageGallery($objectId,$inp,$out){

        $md5name = md5("Image".$objectId);
        $output = $out.$md5name;

        $img = Image::make($inp)->resize(110, null, function ($constraint) {$constraint->aspectRatio();})->save($output.'_XS.jpg');
        $img = Image::make($inp)->resize(150, null, function ($constraint) {$constraint->aspectRatio();})->save($output.'_S.jpg');
        $img = Image::make($inp)->resize(300, null, function ($constraint) {$constraint->aspectRatio();})->save($output.'_M.jpg');
        $img = Image::make($inp)->resize(640, null, function ($constraint) {$constraint->aspectRatio();})->save($output.'_L.jpg');
    }

    /**
     * Return original images for site's object.
     *
     * @param  $objectPath string, path for object related from public/images
     * @return array with images attributes
     */
    protected function getOriginalImage($objectPath,$objectId,$imageType=''){

        $basePath = '/images/'.$objectPath.DIRECTORY_SEPARATOR.$objectId.DIRECTORY_SEPARATOR.$imageType.DIRECTORY_SEPARATOR;

        $imageAttributes = array();

        $imageAttributes['relativePath'] = '';
        $imageAttributes['fullPath'] = '';
        $imageAttributes['fullPathToImageGallery'] = '';
        $imageAttributes['imageFileName'] = '';
        $imageAttributes['qualifiedImageName'] = '';
        $imageAttributes['url'] = '';

        $imageAttributes['relativePath'] = $basePath.'original/';
        $imageAttributes['fullPathToImageGallery'] = public_path().$basePath;
        $imageAttributes['fullPath'] = public_path().$imageAttributes['relativePath'];

        if (file_exists($imageAttributes['fullPath'])) {
            $files = scandir($imageAttributes['fullPath'],1);
            $imageAttributes['imageFileName'] = $files[0];
            $imageAttributes['qualifiedImageName'] = $imageAttributes['fullPath'].$imageAttributes['imageFileName'];
            $imageAttributes['url'] = $imageAttributes['relativePath'] .$imageAttributes['imageFileName'];
        }

       // return dd($imageAttributes);

        return $imageAttributes;
    }
    protected function getFiles($objectPath,$objectId,$imageType=''){

        $basePath = '/images/'.$objectPath.DIRECTORY_SEPARATOR.$objectId.DIRECTORY_SEPARATOR.$imageType.DIRECTORY_SEPARATOR;

        $imageAttributes = array();

        $imageAttributes['relativePath'] = '';
        $imageAttributes['fullPath'] = '';
        $imageAttributes['fullPathToImageGallery'] = '';
        $imageAttributes['imageFileName'] = '';
        $imageAttributes['qualifiedImageName'] = '';
        $imageAttributes['url'] = '';

        $imageAttributes['relativePath'] = $basePath.'original/';
        $imageAttributes['fullPathToImageGallery'] = public_path().$basePath;
        $imageAttributes['fullPath'] = public_path().$imageAttributes['relativePath'];

        $articleFiles = array();
        if (file_exists($imageAttributes['fullPath'])) {
            //$files = scandir($imageAttributes['fullPath'],1);
            $files = array_diff(scandir($imageAttributes['fullPath'],1), array('..', '.'));

            foreach ($files as $file) {
                $fileAttributes['relativePath'] = $imageAttributes['relativePath'];
                $fileAttributes['fullPath'] = $imageAttributes['fullPath'];
                $fileAttributes['fullPathToImageGallery'] = $imageAttributes['fullPathToImageGallery'];
                $fileAttributes['imageFileName'] = $file;
                $fileAttributes['qualifiedImageName'] = $fileAttributes['fullPath'].$fileAttributes['imageFileName'];
                $fileAttributes['url'] = $fileAttributes['relativePath'] .$fileAttributes['imageFileName'];
                $articleFiles[]=$fileAttributes;
                unset($fileAttributes);
            }
        }

        //return dd($articleFiles,$files);

        return $articleFiles;
    }

    protected function deleteFile ($file){

        unlink ( $file );

        return;
    }

    protected function saveOriginalImage($imageName,$file,$objectPath,$objectId,$imageType){

        $patterns = array();
        $patterns[0] = '/ /';
        $patterns[1] = '/&/';
        $replacement = '_';
        $OriginalName = preg_replace($patterns, $replacement, $imageName);

        $newImage = $this->getOriginalImage($objectPath,$objectId,$imageType);
        if ($imageType!='files') {
            Storage::deleteDirectory($newImage['relativePath']);
        }
        $sFile = Storage::putFileAs($newImage['relativePath'] , $file, $OriginalName);

        unset($newImage);

        if ($imageType!='files') {

            $newImage = $this->getOriginalImage($objectPath, $objectId, $imageType);

            $this->createImageGallery($objectId, $newImage['qualifiedImageName'], $newImage['fullPathToImageGallery']);
        }

        return;
    }

    protected function copyOriginalImageWithResizing($objectPath,$oldId,$id,$imageType){

        $oldImage = $this->getOriginalImage($objectPath,$oldId,$imageType);
        $newImage = $this->getOriginalImage($objectPath,$id,$imageType);

        Storage::deleteDirectory($newImage['relativePath']);
        mkdir ( $newImage['fullPath'], 0777, true );
        copy ( $oldImage['qualifiedImageName'],  $newImage['fullPath'].$oldImage['imageFileName']);

        unset($newImage);
        if ($imageType!='files') {
            $newImage = $this->getOriginalImage($objectPath, $id, $imageType);

            $this->createImageGallery($id, $newImage['qualifiedImageName'], $newImage['fullPathToImageGallery']);
        }
        return;
    }
    
}
