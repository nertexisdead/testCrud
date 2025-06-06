<?php

namespace App\Console\Commands;

use App\Models\Synonim;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class GenerateSynonims extends Command
{
    protected $signature = 'app:generate-synonims';

    protected $description = 'Generate synomin content';

    public function handle()
    {
        $filePath = public_path('synonims.xlsx');
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getSheet(0);
        $data = $sheet->toArray(null, true, true, true);

        foreach ($data as $index => $row) {
            if ($index === 1) continue;

            Synonim::create([
                'word' => $row['B'],
                'synonym' => $row['C'],
            ]);
        }

        $this->info("Done: 1000 posts created.");
    }
}
