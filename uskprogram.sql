-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 
-- サーバのバージョン： 10.4.8-MariaDB
-- PHP のバージョン: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `uskprogram`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `pile`
--

CREATE TABLE `pile` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `tag1` varchar(255) NOT NULL,
  `tag2` varchar(255) DEFAULT NULL,
  `tag3` varchar(255) DEFAULT NULL,
  `img` blob DEFAULT NULL,
  `date` date NOT NULL,
  `memo` text DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `answer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `pile`
--

INSERT INTO `pile` (`id`, `title`, `language`, `tag1`, `tag2`, `tag3`, `img`, `date`, `memo`, `type`, `answer`) VALUES
(10, '編集機能', 'php', '#update', '', '', '', '2020-08-09', '編集機能を実装\r\nパスワードが一致した場合、編集ページに移行\r\n→編集ページから入力すると、記事がダブってしまう（新たにIDが振られてしまう）為\r\n　ANSWERのようにUPDATE構文を別ファイルで作っておかないといけないようだ', 'progress', NULL),
(12, 'questionに対するアンサー', 'php', '#mariadb', '', '', '', '2020-10-01', 'クエスチョン画面からアンサー画面を作りたい\r\n＄db->prepareのUPDATE構文でanswerカラムの中身を更新したいけど\r\nFatal errorが出る', 'question', 'update文内では一度 \'：＊＊＊\'(プレースホルダ)の形で入れ込み\r\nbindparamで$answerを代入 !\r\n\r\n一応、最初から変数でもできなくない？かもだけど、上記で解決した  '),
(16, '検索機能の導入', 'php', '#', '', '', '', '2020-10-29', 'タグで検索\r\nフォームに入力→inputボタン押すと入力情報をsearch.phpに渡すと同時に\r\nsearch.phpにページ遷移するようにしたい\r\n\r\n＆search.phpで入力情報を受け取り、\r\nデータベース内のヒットした項目を表示したい', 'question', NULL),
(17, 'tagがばぐっとる', 'php', '#tag1', '#tag2', '', '', '2020-10-29', '修正要', 'question', '⇒修正済み'),
(27, '入力履歴を残さない', 'htmlcss', '#input', '#', '#', '', '2020-11-04', 'pass欄\r\n<input... autocomplete=\"off\">で履歴の記憶機能をオフ\r\n\r\n今後セキュリティ機能もなんとかしないと\r\n', 'progress', NULL),
(28, 'MEMO欄にコード入力すると・・', 'htmlcss', '#MEMO', '#', '#', '', '2020-11-04', 'コードが文字列として反映されない！', 'question', NULL),
(30, '画像が反映されない', 'php', '#sql', '#', '#', '', '2020-11-07', '画像が反映されない\r\n⇒sqlに直接格納じゃなくファイルパスを入れるのがいいらしい\r\n', 'question', NULL),
(31, 'セキュリティ対策', 'php', '#インジェクション', '#SQL', '#', '', '2020-11-09', 'SQLインジェクション', 'todo', NULL),
(32, 'UI/UX改善', 'javascript', '#javascript', '#css', '#センス', '', '2020-11-09', '画面の見栄え\r\n使いやすさ\r\n\r\n⇒css/jsの導入', 'todo', NULL),
(33, 'アラート機能', 'php', '#', '#', '#', '', '2020-11-09', 'ToDoとQuestionの投稿に対し\r\n〇〇日以上経過してもできていない/解決していない投稿は\r\n実施を促すようアラート機能をつける\r\n\r\n⇒まずは赤文字表示とか？', 'todo', NULL),
(34, '投稿数カウント', 'php', '#', '#', '#', '', '2020-11-09', 'カウントにtestを含めないようにする\r\n⇒test投稿を一括削除するボタンで代用する？？', 'todo', NULL),
(35, 'To Do投稿', 'php', '#', '#', '#', '', '2020-11-09', 'To Do投稿に対し\r\n完了したらチェックを入れる欄を作り\r\nチェックが入った投稿はProgressとして表示されるようにする', 'todo', 'finished'),
(36, '説明ページ', 'javasctipt', '#', '#', '#', '', '2020-11-09', '各機能の説明ページの作成\r\n\r\n⇒使い方や工夫した点、今後改善したい点等書いとく\r\n\r\n⇒イメージ：横に小さい吹き出しマークつけて、カーソル当てると\r\n　上記が書かれた吹き出しが大きく出てくる感じ（JavaScriptでできる？）', 'todo', NULL),
(37, 'ページタイトル', 'other', '#センス', '#', '#', '', '2020-11-09', 'Programer Wayは文法間違ってるし\r\nいい感じのタイトル考えないと。。。', 'todo', 'finished'),
(39, '検索条件の複数指定', 'php', '#sql', '#', '#', '', '2020-11-10', '検索対象をtag1,tag2,tag3,languageにしたいが、sql文法が不適のようでうまくいかない\r\n⇒書いた文法：\r\n SELECT * FROM pile WHERE tag1 LIKE :search OR tag2 LIKE :search OR tag3 LIKE :search', 'question', 'プリペアドステートメントを複数に分けた\r\n\r\n  $stmt = $db->prepare(\" SELECT * FROM pile WHERE tag1 LIKE :search1 OR tag2 LIKE :search2 OR tag3 LIKE :search3 OR language LIKE :search4\");\r\n  $stmt->bindParam(\':search1\',$search,PDO::PARAM_STR);\r\n  $stmt->bindParam(\':search2\',$search,PDO::PARAM_STR);\r\n  $stmt->bindParam(\':search3\',$search,PDO::PARAM_STR);\r\n  $stmt->bindParam(\':search4\',$search,PDO::PARAM_STR); '),
(40, 'test', 'other', '#php', '#', '#', '', '2020-11-10', 'test', 'test', NULL),
(41, 'test', 'htmlcss', '#test', '#', '#', '', '2020-11-10', '     <option value=\"javascript\">JavaScript</option>\r\n     <option value=\"htmlcss\">HTML/CSS</option>\r\n     <option value=\"other\">Other</option>', 'test', NULL),
(42, 'git hubにコードをUP', 'other', '#git', '#github', '#', '', '2020-11-16', '下記を参照した\r\nhttps://www.udemy.com/course/intro_git/', 'progress', NULL),
(43, 'gitbashでherokuにログイン後のコマンドが処理されない', 'other', '#gitbash', '#heroku', '#', '', '2020-11-19', 'logged  in as ~\r\nの後ろに\r\n\r\n”81805@DESKTOP-S4MH7RA MINGW64 ~\r\n　$　　　　　”\r\n\r\nが出ない ', 'question', '81805@DESKTOP-S4MH7RA MINGW64 ~\r\n$　\r\n\r\nをコピペしようと\r\nCtrl＋C押したら\r\n\r\nTerminate batch job (Y/N)?\r\nと表示され、\r\n\r\nY⇒Enter押したらいけた。。。（なぜかはわからん）');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `pile`
--
ALTER TABLE `pile`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `pile`
--
ALTER TABLE `pile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
