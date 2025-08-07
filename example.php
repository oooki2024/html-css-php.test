<?php
echo "こんにちは、世界！";


// ここにPHPのコードを追加できます
// 例えば、変数の定義や関数の作成など
$greeting = "こんにちは、PHP！";
echo $greeting;

// HTMLの出力例
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Example</title>
</head>
<body>
    <h1><?php echo $greeting; ?></h1>
</body>
</html><?php

// ここにさらにPHPのコードを追加できます
// 例えば、配列の操作やループ処理など
$fruits = ["りんご", "ばなな", "みかん"];
foreach ($fruits as $fruit) {
    echo "<p>果物: $fruit</p>";
}

// 関数の定義例
function greet($name)
{
    return "こんにちは、$name!";
}

echo greet("ユーザー");

// PHPの終了タグは省略可能ですが、ファイルの終わりに書くこともできます
?>
<?php
// ここにさらにPHPのコードを追加できます
// 例えば、条件分岐やループなど
$number = 5;
if ($number > 0) {
    echo "<p>$number は正の数です。</p>";
} else {
    echo "<p>$number は正の数ではありません。</p>";
}
?><?php
// ここにさらにPHPのコードを追加できます
// 例えば、日付の表示や計算など
$date = date("Y-m-d H:i:s");
echo "<p>現在の日付と時刻: $date</p>";

// 数値の計算例
$sum = 10 + 20;
echo "<p>10 + 20 = $sum</p>";
?>        
