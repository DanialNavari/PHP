saveTemp($data['id'], $pos, 0);
        $text = 'وضعیت خروج از فروشگاه را انتخاب کنید';
        sendMessage($data['id'], $text, $btn_visit_2, $bot_id);
        checkState($data['id'], null, '34');