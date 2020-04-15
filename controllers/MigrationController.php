<?php
/***
 * @authors Annemarieke van Veen and Katja Liotto
 * @copyright All rights reserved.
 */

/***
 * Class MigrationController; migrates the user and videos
 */
class MigrationController extends BaseController
{
    public $file = './views/home';

    // Migrates user from UserModel
    public function migrateUser()
    {
        UserModel::migrate();
    }

    // Migrates videos from VideoModel
    public function migrateVideos()
    {
        VideoModel::migrateVideos();
    }
}