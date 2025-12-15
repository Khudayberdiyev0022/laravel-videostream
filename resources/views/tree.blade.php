<!DOCTYPE html>
<html lang="uz">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ўзбекистон Республикаси Одил судлов академияси</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      padding: 40px 20px;
      background: #f5f5f5;
    }

    .header {
      text-align: center;
      margin-bottom: 60px;
    }

    .header h1 {
      font-size: 14px;
      margin-bottom: 5px;
    }

    .header h2 {
      font-size: 16px;
      font-weight: bold;
      margin-top: 15px;
    }

    /* Main container */
    .org-structure {
      max-width: 1600px;
      margin: 0 auto;
      position: relative;
    }

    /* Top row with Matbuot, Rektor, Akademiya */
    .top-level {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 40px;
      margin-bottom: 60px;
      position: relative;
    }

    /* Box styling */
    .box {
      border: 2px solid #333;
      padding: 12px 20px;
      background: white;
      font-size: 12px;
      border-radius: 5px;
      transition: all 0.3s;
      position: relative;
      cursor: pointer;
      line-height: 1.4;
      text-align: center;
      min-height: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .box.dashed {
      border-style: dashed;
    }

    .box-number {
      position: absolute;
      bottom: 5px;
      right: 10px;
      font-size: 11px;
      font-weight: bold;
    }

    /* Hover effects */
    .box:hover {
      background: #c8e4f8;
      border-color: #94a0b4;
      color: #000;
    }

    /* Connection wrapper */
    .connection-wrapper {
      position: relative;
    }

    /* Vertical line from Rektor */
    .v-line-rektor {
      position: absolute;
      top: 100%;
      left: 50%;
      width: 2px;
      height: 60px;
      background: #333;
      transform: translateX(-1px);
      transition: background 0.3s;
    }

    /* Main departments grid */
    .departments {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 30px;
      position: relative;
    }

    /* Horizontal connector line at top */
    .h-line-connector {
      position: absolute;
      top: 0;
      left: 12.5%;
      right: 12.5%;
      height: 2px;
      background: #333;
      transition: background 0.3s;
    }

    /* Department column */
    .department-column {
      display: flex;
      flex-direction: column;
      gap: 15px;
      position: relative;
      padding-top: 30px;
    }

    /* Vertical line from horizontal to column */
    .v-line-to-dept {
      position: absolute;
      top: 0;
      left: 50%;
      width: 2px;
      height: 30px;
      background: #333;
      transform: translateX(-1px);
      transition: background 0.3s;
    }

    /* Vertical line from parent to children */
    .v-line-to-children {
      position: absolute;
      bottom: -15px;
      left: 50%;
      width: 2px;
      height: 15px;
      background: #333;
      transform: translateX(-1px);
      transition: background 0.3s;
    }

    /* Parent with children */
    .parent-box {
      position: relative;
      margin-bottom: 15px;
    }

    .children-boxes {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    /* Hover effects for columns */
    .department-column:hover .box {
      background: #c8e4f8;
      border-color: #94a0b4;
      color: #000;
    }

    .department-column:hover .v-line-to-dept,
    .department-column:hover .v-line-to-children {
      background: #94a0b4;
    }

    .top-level:hover .v-line-rektor {
      background: #94a0b4;
    }

    .departments:hover .h-line-connector {
      background: #94a0b4;
    }

    /* Note section */
    .note {
      margin-top: 60px;
      font-size: 12px;
      padding: 20px;
      background: white;
      border: 1px solid #ccc;
    }

    .note strong {
      text-decoration: underline;
    }
  </style>
</head>
<body>
<div class="header">
  <h1>Ўзбекистон Республикаси Президентининг</h1>
  <h1>2025 йил 21 августдаги ПҚ-М-соп <span style="color: red;">қарорининг</span></h1>
  <h1>1-иловаси</h1>
  <h2>Ўзбекистон Республикаси Одил судлов академиясининг<br>ТУЗИЛМАСИ</h2>
</div>

<div class="org-structure">
  <!-- Top Level -->
  <div class="top-level">
    <div class="box">
      Матбуот хизмати
      <div class="box-number">1</div>
    </div>
    <div class="connection-wrapper">
      <div class="box">
        Ректор
      </div>
      <div class="v-line-rektor"></div>
    </div>
    <div class="box dashed">
      Академия кенгаши
    </div>
  </div>

  <!-- Main Departments -->
  <div class="departments">
    <div class="h-line-connector"></div>

    <!-- Left Column - Kafedra -->
    <div class="department-column">
      <div class="v-line-to-dept"></div>
      <div class="box">
        Фуқаролик-хуқуқий<br>фанлар кафедраси
        <div class="box-number">3</div>
      </div>
      <div class="box">
        Жиноят-хуқуқий<br>фанлар кафедраси
        <div class="box-number">3</div>
      </div>
      <div class="box">
        Маъмурий-хуқуқий<br>фанлар кафедраси
        <div class="box-number">3</div>
      </div>
      <div class="box">
        Иқтисодий-хуқуқий<br>фанлар кафедраси
        <div class="box-number">3</div>
      </div>
      <div class="box">
        Инсон хуқуқлари, халқаро хуқуқ ва интеллектуал мулк фанлар кафедраси
        <div class="box-number">4</div>
      </div>
      <div class="box">
        Касбий ориниҳалар<br>кафедраси
        <div class="box-number">2</div>
      </div>
    </div>

    <!-- Center Left - O'quv-uslubiy -->
    <div class="department-column">
      <div class="v-line-to-dept"></div>
      <div class="parent-box">
        <div class="box">
          Ўқув-услубий ишлар бўйича проректор
        </div>
        <div class="v-line-to-children"></div>
      </div>
      <div class="children-boxes">
        <div class="box">
          Ўқув-услубий бўлим
          <div class="box-number">2</div>
        </div>
        <div class="box">
          Магистратура факултети
          <div class="box-number">2</div>
        </div>
        <div class="box">
          Малака ошириш ва қайта тайёрлаш факултети
          <div class="box-number">1</div>
        </div>
      </div>
    </div>

    <!-- Center Right - Ilmiy innovatsiyalar -->
    <div class="department-column">
      <div class="v-line-to-dept"></div>
      <div class="parent-box">
        <div class="box">
          Илмий инновациялар ва ахборот-технология ишлар бўйича проректор
        </div>
        <div class="v-line-to-children"></div>
      </div>
      <div class="children-boxes">
        <div class="box">
          Илмий тадқиқотларни мувофиқлаштириш бўлими
          <div class="box-number">1</div>
        </div>
        <div class="box">
          Ёшлар билан ишлаш, маънавият-маърифат бўлими
          <div class="box-number">1</div>
        </div>
        <div class="box">
          Халқаро ҳамкорлик бўлими
          <div class="box-number">1</div>
        </div>
        <div class="box">
          Ахборот-ресурс маркази
          <div class="box-number">1</div>
        </div>
        <div class="box">
          Ахборот-технология таъминот ва масофавий ўқитиш бўлими
          <div class="box-number">1</div>
        </div>
      </div>
    </div>

    <!-- Right Column - Buxgalteriya -->
    <div class="department-column">
      <div class="v-line-to-dept"></div>
      <div class="box">
        Бухгалтерия
        <div class="box-number">2</div>
      </div>
      <div class="box">
        Кадрлар бўлими
        <div class="box-number">1</div>
      </div>
      <div class="box">
        Девонхона ва архив
        <div class="box-number">1</div>
      </div>
      <div class="box">
        Хуқиқий бўлими
        <div class="box-number">1</div>
      </div>
    </div>
  </div>
</div>

<div class="note">
  <p><strong><u>Изоҳ:</u></strong></p>
  <p><i>Академиянинг бошқарув ходимлари сони (ректор ва проректорлар ҳисобга олинмаганда) — 37 бирлик, шу жумаладан, проректорлар бўйсунувидаги ходимлар — 15 бирлик, бошқа ходимлар — 19 бирлик;</i></p>
  <p><i>Техник ҳисобланувчи ходимлар ва хизмат кўрсатувчи ходимлар сони академиянинг фаолият ҳажмидан келиб чиққан ҳолда белгиланади.</i></p>
</div>
</body>
</html>
