<?php

namespace Sxy\Webhooks;

use App\Http\Controllers\Controller;

class Webhooks extends Controller
{
    public function printRunning()
    {
        echo 'running';
    }

    public function handle($request)
    {
        $hmac_header = $request->header('X-Gogs-Signature');
        $data = $request->getContent();

        if ($this->verify_webhook($data, $hmac_header)) {
            $basePath = base_path();
            $cmd = "cd $basePath \n git pull 2>&1";
            $outout = [];
            exec($cmd, $outout);
            logger()->debug($request->json('ref'));
            logger()->debug(implode("\n", $outout));

            return implode("\n", $outout);
        } else {
            logger()->debug('unauthed push event');
        }
    }

    private function verify_webhook($data, $hmac_header)
    {
        $calculated_hmac = hash_hmac('sha256', $data, config('web_hooks.gogs_key', env('webhooks_gogs_key')), false);
        return ($hmac_header == $calculated_hmac);
    }
}