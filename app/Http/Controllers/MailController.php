<?php

namespace App\Http\Controllers;

use App\Mail\Dev;
use App\Mail\ReplyNotice;
use App\Mail\SystemNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function replyNotice(Request $request)
    {
        $mailEntity = new ReplyNotice();
        $mailEntity->setContent($request->post('content'));
        $mailEntity->setAppName($request->post('app_name', config('app.name')));
        $mailEntity->setArticleUrl($request->post('article_url', config('app.url')));
        $mailEntity->setOriginContent($request->post('origin_content'));
        $mailEntity->setReplyUsername($request->post('reply_username'));
        $mailEntity->setSubject($request->post('subject'));
        $mailEntity->setUrl($request->post('url', config('app.url')));
        $mailEntity->setUsername($request->post('username'));
        $mailEntity->setFromEmail($request->post('from_email'));
        $mailEntity->setFromName($request->post('from_name'));

        try {
            Mail::to($request->post('to_mail'))->send($mailEntity);
        } catch (\Exception $exception) {
            \Log::error('发送邮件失败 ： ' . json_encode(get_object_vars($mailEntity)) . ' ; message : ' . $exception->getMessage());
            return response('failed', 500);
        }
        \Log::info('发送邮件成功 ： ' . json_encode(get_object_vars($mailEntity)));
        return response('success', 200);
    }

    public function systemNotice(Request $request)
    {
        $mailEntity = new SystemNotice();
        $mailEntity->setContent($request->post('content'));
        $mailEntity->setSystemEmail($request->post('system_email'));
        $mailEntity->setSystemName($request->post('system_name'));
        $mailEntity->setSystemHomepage($request->post('system_homepage'));
        $mailEntity->setSubject($request->post('subject'));

        try {
            Mail::to($request->post('to_mail'))->send($mailEntity);
        } catch (\Exception $exception) {
            \Log::error('发送邮件失败 ： ' . json_encode(get_object_vars($mailEntity)) . ' ; message : ' . $exception->getMessage());
            return response('failed', 500);
        }
        \Log::info('发送邮件成功 ： ' . json_encode(get_object_vars($mailEntity)));
        return response('success', 200);
    }
}
