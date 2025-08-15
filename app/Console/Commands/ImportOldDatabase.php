<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\Family;
use App\Models\Culture;
use App\Models\Insect;
use App\Models\CommonName;
use App\Models\InsectCulture;
use App\Models\InsectImage;

class ImportOldDatabase extends Command
{
    protected $signature = 'import:old_database';
    protected $description = 'Import data from old Portuguese database to new English database with S3 images';

    public function handle()
    {
        $this->info('Starting import...');

        try {
            // 1. Orders
            $this->info('Importing Orders...');
            $oldOrders = DB::connection('mysql_old')->table('ordem')->get();
            foreach ($oldOrders as $old) {
                Order::create([
                    'id' => $old->id,
                    'name' => $old->nome_ordem,
                ]);
                $this->info("Order imported: {$old->nome_ordem}");
            }

            // 2. Families
            $this->info('Importing Families...');
            $oldFamilies = DB::connection('mysql_old')->table('familia')->get();
            foreach ($oldFamilies as $old) {
                Family::create([
                    'id' => $old->id,
                    'name' => $old->nome_familia,
                    'order_id' => $old->id_ordem,
                ]);
                $this->info("Family imported: {$old->nome_familia}");
            }

            // 3. Cultures
            $this->info('Importing Cultures...');
            $oldCultures = DB::connection('mysql_old')->table('culturas')->get();
            foreach ($oldCultures as $old) {
                Culture::create([
                    'id' => $old->id,
                    'name' => $old->nome_cultura,
                ]);
                $this->info("Culture imported: {$old->nome_cultura}");
            }

            // 4. Insects
            $this->info('Importing Insects...');
            $oldInsects = DB::connection('mysql_old')->table('insetos')->get();
            foreach ($oldInsects as $old) {
                Insect::create([
                    'id' => $old->id,
                    'scientific_name' => $old->nome_cientifico,
                    'order_id' => $old->id_ordem,
                    'family_id' => $old->id_familia,
                    'predator' => $old->predador,
                    'importance' => $old->importancia,
                    'morphology' => $old->morfologia,
                ]);
                $this->info("Insect imported: {$old->nome_cientifico}");
            }

            // 5. Common Names
            $this->info('Importing Common Names...');
            $oldCommonNames = DB::connection('mysql_old')->table('nomes_comuns')->get();
            foreach ($oldCommonNames as $old) {
                CommonName::create([
                    'id' => $old->id,
                    'insect_id' => $old->id_inseto,
                    'name' => $old->nome_comum,
                ]);
                $this->info("Common Name imported: {$old->nome_comum}");
            }

            // 6. Insect-Culture
            $this->info('Importing Insect-Culture relations...');
            $oldInsectCulture = DB::connection('mysql_old')->table('inseto_cultura')->get();
            foreach ($oldInsectCulture as $old) {
                DB::table('insect_culture')->insert([
                    'id' => $old->id,
                    'insect_id' => $old->id_inseto,
                    'culture_id' => $old->id_cultura,
                ]);
                $this->info("Imported Insect-Culture relation: Insect {$old->id_inseto} -> Culture {$old->id_cultura}");
            }

            // // 7. Insect Images (upload S3)
            // $this->info('Importing Insect Images to S3...');
            // $oldImages = DB::connection('mysql_old')->table('inseto_imagens')->get();
            // foreach ($oldImages as $old) {
            //     $tmpFile = tmpfile();
            //     fwrite($tmpFile, $old->imagem);
            //     $meta = stream_get_meta_data($tmpFile);
            //     $tmpPath = $meta['uri'];

            //     $ext = $this->getImageExtension($old->imagem) ?: 'jpg';
            //     $filename = 'insects/' . uniqid() . '.' . $ext;

            //     $path = Storage::disk('s3')->putFileAs('insects', $tmpPath, basename($filename));

            //     InsectImage::create([
            //         'insect_id' => $old->id_inseto,
            //         'image_path' => $path,
            //     ]);

            //     fclose($tmpFile);

            //     $this->info("Insect Image imported for insect ID: {$old->id_inseto}");
            // }

            $this->info('Import finished successfully!');
        } catch (\Exception $e) {
            $this->error("Import failed: " . $e->getMessage());
            return 1;
        }

        return 0;
    }

    /**
     * Detect image extension from blob data
     */
    // private function getImageExtension($blob)
    // {
    //     $finfo = finfo_open();
    //     $mime = finfo_buffer($finfo, $blob, FILEINFO_MIME_TYPE);
    //     finfo_close($finfo);

    //     switch ($mime) {
    //         case 'image/jpeg':
    //             return 'jpg';
    //         case 'image/png':
    //             return 'png';
    //         case 'image/gif':
    //             return 'gif';
    //         default:
    //             return null;
    //     }
    // }
}
