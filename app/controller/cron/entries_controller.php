<?php

require_once(Config::get('CONTROLLER_DIR') . 'cron/cron_controller.php');

class EntriesController extends CronController
{

  /**
   * 記事の予約投稿、期間投稿処理
   */
  public function updateOpenStatus()
  {
    $blog_id = $this->getBlogId();
    if (empty($blog_id)) {
      // blog_idが指定されていない場合は処理しない
      // cron実行時であればblog_id無し(全体)で処理を行う
      return ;
    }

    $entriesModel = Model::load('Entries');

    // 予約投稿処理
    $entriesModel->updateReservation($blog_id);

    // 期間限定処理
    $entriesModel->updateLimited($blog_id);
  }

}

