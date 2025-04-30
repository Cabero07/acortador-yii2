<?php
use yii\db\Migration;

class m230501_000000_sync_balance extends Migration
{
    public function safeUp()
    {
        $users = (new \yii\db\Query())
            ->select(['user.id', 'SUM(link_stats.earnings) as total_earnings'])
            ->from('user')
            ->leftJoin('links', 'links.user_id = user.id')
            ->leftJoin('link_stats', 'link_stats.link_id = links.id')
            ->groupBy('user.id')
            ->all();

        foreach ($users as $user) {
            $this->update('user', ['balance' => $user['total_earnings']], ['id' => $user['id']]);
        }
    }

    public function safeDown()
    {
        $this->update('user', ['balance' => 0]);
    }
}