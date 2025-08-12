<?php
// タイムゾーン（日本）
date_default_timezone_set('Asia/Tokyo');

// パラメータ（未指定なら当月）
$year  = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');
$month = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('n');

// 値のガード（1〜12の範囲）
if ($month < 1 || $month > 12) {
    $month = (int)date('n');
}

// その月の1日と日数
$firstDayTs   = strtotime(sprintf('%04d-%02d-01', $year, $month));
$daysInMonth  = (int)date('t', $firstDayTs);

// 曜日ラベル（0:日〜6:土）
$weekdays = ['日', '月', '火', '水', '木', '金', '土'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PHPミニカレンダー</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
  <main class="container">
    <h1>PHP × HTML × CSS ミニカレンダー</h1>

    <!-- 年月フォーム -->
    <form class="controls" method="get" action="">
      <label>
        年:
        <input type="number" name="year" value="<?= htmlspecialchars($year) ?>" min="1970" max="2100" required>
      </label>
      <label>
        月:
        <input type="number" name="month" value="<?= htmlspecialchars($month) ?>" min="1" max="12" required>
      </label>
      <button type="submit">表示</button>
    </form>

    <h2><?= htmlspecialchars($year) ?>年 <?= htmlspecialchars($month) ?>月</h2>

    <!-- カレンダー（表） -->
    <table class="calendar">
      <thead>
        <tr>
          <?php foreach ($weekdays as $i => $w): ?>
            <th class="<?= $i === 0 ? 'sun' : ($i === 6 ? 'sat' : '') ?>">
              <?= $w ?>
            </th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php
        // その月の1日の曜日（0:日〜6:土）
        $firstWeekday = (int)date('w', $firstDayTs);

// 表は週ごと（行）に出力
$day = 1;

// 最低でも6行分の枠を回せばどの月も収まる
for ($week = 0; $week < 6; $week++) {
    echo '<tr>';

    for ($dow = 0; $dow < 7; $dow++) {
        // 1週目の前空きセル
        if ($week === 0 && $dow < $firstWeekday) {
            echo '<td class="empty"></td>';
            continue;
        }

        // 月末を過ぎたら空セル
        if ($day > $daysInMonth) {
            echo '<td class="empty"></td>';
            continue;
        }

        // 当日判定（任意）
        $isToday = ($year == (int)date('Y') && $month == (int)date('n') && $day == (int)date('j'));

        // 曜日クラス
        $cls = $dow === 0 ? 'sun' : ($dow === 6 ? 'sat' : '');
        if ($isToday) {
            $cls .= ($cls ? ' ' : '') . 'today';
        }

        // 出力
        $ts = strtotime(sprintf('%04d-%02d-%02d', $year, $month, $day));
        $label = date('Y-m-d', $ts) . '（' . $weekdays[$dow] . '）';

        echo '<td class="' . $cls . '">';
        echo '<div class="day-num">' . $day . '</div>';
        echo '<div class="ymd">' . htmlspecialchars($label) . '</div>';
        echo '</td>';

        $day++;
    }

    echo '</tr>';

    // すべて出力済みなら終了
    if ($day > $daysInMonth) {
        break;
    }
}
?>
      </tbody>
    </table>

    <p class="note">※「年・月」を変更して <strong>表示</strong> を押すと、その月のカレンダーが更新されます。</p>
  </main>
</body>
</html>