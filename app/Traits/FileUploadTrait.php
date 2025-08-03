<?php

namespace App\Traits;

/**
 * Description of ImageUploadTrait
 *
 * @author eyad_elfarra
 */
trait FileUploadTrait {
    //put your code here

    public function uploadChatAttachment($file , $chat_id , $id) {
        $dir = 'chats/' . $chat_id;
        return $this->upload($file, $dir, $id);
    }
    public function upload($file , $dir , $id) { // Taking input image as parameter
        if($file == null || $file == "undefined")
            return "";
        $file_name = $id;
        $ext = strtolower($file->getClientOriginalExtension()); // You can use also getClientOriginalName()
        $file_full_name = $file_name . '.' . $ext;
        $upload_path = 'uploads/' . $dir . '/';    //Creating Sub directory in Public folder to put image
        $file_url = $upload_path . $file_full_name;
        $success = $file->move($upload_path, $file_full_name);

        return $file_url; // Just return image
    }
    //TODO:: upload and save function
}
