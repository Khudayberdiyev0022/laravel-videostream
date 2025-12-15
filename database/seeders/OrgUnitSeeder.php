<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrgUnit;

class OrgUnitSeeder extends Seeder
{
  public function run(): void
  {
    OrgUnit::truncate();

    /** 1-DARAJA */
    $rektor = OrgUnit::create([
      'title'     => 'Rektor',
      'parent_id' => null,
      'position'  => 1,
    ]);

    /** 2-DARAJA */
    OrgUnit::create([
      'title'     => 'Matbuot xizmati',
      'parent_id' => $rektor->id,
      'position'  => 1,
    ]);

    OrgUnit::create([
      'title'     => 'Akademiya kengashi',
      'parent_id' => $rektor->id,
      'position'  => 2,
      'is_dashed' => true,
    ]);

    /** 3-DARAJA – CHAP BLOK (KAFEDRALAR) */
    $leftUnits = [
      'Fuqarolik-huquqiy fanlar kafedrasi',
      'Jinoyat-huquqiy fanlar kafedrasi',
      'Maʼmuriy-huquqiy fanlar kafedrasi',
      'Iqtisodiy-huquqiy fanlar kafedrasi',
      'Inson huquqlari va xalqaro huquq kafedrasi',
      'Kasbiy ko‘nikmalar kafedrasi',
    ];

    foreach ($leftUnits as $index => $title) {
      OrgUnit::create([
        'title'     => $title,
        'parent_id' => $rektor->id,
        'position'  => 10 + $index,
      ]);
    }

    /** 3-DARAJA – O‘RTA BLOK */
    $studyViceRector = OrgUnit::create([
      'title'     => 'O‘quv-uslubiy ishlar bo‘yicha prorektor',
      'parent_id' => $rektor->id,
      'position'  => 20,
    ]);

    OrgUnit::create([
      'title'     => 'O‘quv-uslubiy bo‘lim',
      'parent_id' => $studyViceRector->id,
      'position'  => 1,
    ]);

    OrgUnit::create([
      'title'     => 'Magistratura fakulteti',
      'parent_id' => $studyViceRector->id,
      'position'  => 2,
    ]);

    OrgUnit::create([
      'title'     => 'Malaka oshirish va qayta tayyorlash fakulteti',
      'parent_id' => $studyViceRector->id,
      'position'  => 3,
    ]);

    /** 3-DARAJA – O‘NG BLOK */
    $scienceViceRector = OrgUnit::create([
      'title'     => 'Ilmiy va innovatsiyalar bo‘yicha prorektor',
      'parent_id' => $rektor->id,
      'position'  => 30,
    ]);

    $rightUnits = [
      'Ilmiy tadqiqotlarni muvofiqlashtirish bo‘limi',
      'Xalqaro hamkorlik bo‘limi',
      'Axborot-resurs markazi',
      'Buxgalteriya',
      'Kadrlar bo‘limi',
      'Devonxona va arxiv',
      'Xo‘jalik bo‘limi',
    ];

    foreach ($rightUnits as $index => $title) {
      OrgUnit::create([
        'title'     => $title,
        'parent_id' => $scienceViceRector->id,
        'position'  => $index + 1,
      ]);
    }
  }
}
