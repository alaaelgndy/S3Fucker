<?php

namespace Elgndy\S3Fucker\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Helper\ProgressBar;

class S3Downloader extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elgndy:s3-fucker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will download the whole public files on s3 using the urls in the config file';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $downloadsFolder = $this->generateDownloadsFolder();

        $urls = config('elgndy_s3_fucker.urls');

        $bar = new ProgressBar($this->output, count($urls));

        $bar->start();

        $i = 1;
        foreach ($urls as $url) {
            $fileUrlToArray = explode('/', $url);
            $fileName = end($fileUrlToArray);

            if (!File::exists($downloadsFolder.$fileName)) {
                shell_exec('touch '.$downloadsFolder.$fileName);
                $filePath = $downloadsFolder.$fileName;
            } else {
                $bar->advance();
                continue;
            }
            copy($url, $filePath);

            $bar->advance();
        }
        $bar->finish();
    }

    private function generateDownloadsFolder(): string
    {
        $finalFolder = '';
        $baseFolder = storage_path().'/app/';

        $downloadsFolder = $baseFolder.'downloads/';

        // downloads folder
        if (!File::exists($downloadsFolder)) {
            File::makeDirectory($downloadsFolder);
            $finalFolder = $downloadsFolder;
        }

        // create configured path
        if (config('elgndy_s3_fucker.folder_name') !== null) {
            $configuredFolder = $downloadsFolder.config('elgndy_s3_fucker.folder_name');
            if (!File::exists($configuredFolder)) {
                File::makeDirectory($configuredFolder);
            }
            $finalFolder = $configuredFolder;
        }

        return $finalFolder;
    }
}
