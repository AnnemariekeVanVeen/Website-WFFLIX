<?php
/***
 * @authors Annemarieke van Veen and Katja Liotto
 * @copyright All rights reserved.
 */

/***
 * Class VideosController; connects with video view
 */
class VideosController extends BaseController
{
    public $file = './views/videos/';
    public $style = './src/css/';

    // Index page

    public function videos()
    {
        // Delete a video by id.
        if (isset($_POST["delete"]) && isset($_POST["id"]) && is_numeric($_POST["id"])) {
            if (VideoModel::destroyVideo($_POST["id"])):
                Session::flash('alert', 'Video Deleted');
            else:
                Session::flash('alert', 'Deleting Video Failed');
            endif;
        } // Adds a new video
        else if (isset($_POST["create"])) {

            $target_dir = "src/videos/";
            $target_file = $target_dir . basename($_FILES["video_upload"]["name"]);

            // UploadOk goes to 0 on an upload error
            $uploadOk = 1;
            $videoFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


// Check if file already exists
            if (file_exists($target_file)) {
                Session::flash('alert', "Sorry, file already exists.");
                $uploadOk = 0;
            }

            // Allow certain file formats
            if ($videoFileType != "mp4") {
                Session::flash('alert', "Sorry, only mp4 files are allowed.");
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk === 1) {
                if (move_uploaded_file($_FILES["video_upload"]["tmp_name"], $target_file)) {
                    $_POST["video"] = basename($_FILES["video_upload"]["name"]);
                } else {
                    Session::flash('alert', "Sorry, there was an error uploading your file.");
                    $uploadOk = 0;
                }
            }
            // confirms that video is added
            if ($uploadOk === 1) {
                if (VideoModel::createVideo($_POST)):
                    Session::flash('alert', 'Video Added');
                else:
                    Session::flash('alert', 'Adding Video Failed');
                endif;
            }
        }

        $this->file .= "videos.view.php";
        $this->style .= "video.css";

        // Filter function; filters programming language
        if (isset($_GET['unix']) && isset($_GET['c_sharp']) && isset($_GET['css']) && isset($_GET['html']) && isset($_GET['php'])):
            $unix = VideoModel::find_byVideo('video_subject', 'unix');
            $c_sharp = VideoModel::find_byVideo('video_subject', 'c_sharp');
            $html = VideoModel::find_byVideo('video_subject', 'html');
            $css = VideoModel::find_byVideo('video_subject', 'css');
            $php = VideoModel::find_byVideo('video_subject', 'php');
            $data['videos'] = array_merge_recursive($unix, $c_sharp, $html, $css, $php);
            $this->render($data);
        elseif (isset($_GET['unix'])):
            $data['videos'] = VideoModel::find_byVideo('video_subject', 'unix');
            $this->render($data);
        elseif (isset($_GET['c_sharp'])):
            $data['videos'] = VideoModel::find_byVideo('video_subject', 'c_sharp');
            $this->render($data);
        elseif (isset($_GET['html'])):
            $data['videos'] = VideoModel::find_byVideo('video_subject', 'html');
            $this->render($data);
        elseif (isset($_GET['css'])):
            $data['videos'] = VideoModel::find_byVideo('video_subject', 'css');
            $this->render($data);
        elseif (isset($_GET['php'])):
            $data['videos'] = VideoModel::find_byVideo('video_subject', 'php');
            $this->render($data);
        else:
            $unix = VideoModel::find_byVideo('video_subject', 'unix');
            $c_sharp = VideoModel::find_byVideo('video_subject', 'c_sharp');
            $html = VideoModel::find_byVideo('video_subject', 'html');
            $css = VideoModel::find_byVideo('video_subject', 'css');
            $php = VideoModel::find_byVideo('video_subject', 'php');
            $data['videos'] = array_merge_recursive($unix, $c_sharp, $html, $css, $php);
            $this->render($data);
        endif;
    }
}