-- SQL操作

-- 1. 予約表の出力
SELECT * FROM Reservation;

-- 2. 予約表を予約日、予約時間の昇順で出力
SELECT * FROM Reservation
    ORDER BY res_date, res_time;

-- 3. 予約表から予約日が6/23か6/30のデータを出力
SELECT * FROM Reservation
    WHERE res_date IN ('2021-06-23', '2021-06-30');

-- 4. 個人データ表から住所が守谷市のデータを出力
SELECT * FROM Citizen
    WHERE address LIKE '%守谷市%';

-- 5. 年齢の計算★
SELECT my_num AS マイナンバー, name AS 氏名, 
    birth AS 生年月日, TIMESTAMPDIFF(YEAR, birth, CURDATE()) AS 年齢
    FROM Citizen;

-- 6-1. 予約者のマイナンバーと名前
SELECT DISTINCT R.my_num AS マイナンバー, C.name AS 名前
    FROM Reservation AS R
    JOIN Citizen AS C ON R.my_num = C.my_num;

-- 6-2. 予約者のマイナンバーと名前
SELECT DISTINCT R.my_num AS マイナンバー, C.name AS 名前
    FROM Reservation AS R
    JOIN Citizen AS C USING(my_num);

-- 7. 接種完了数の出力★
SELECT COUNT(*) AS 接種完了数
    FROM Reservation
    WHERE sta_code = 1;

-- 8. ワクチンの種類別予約数★
SELECT V.vac_name AS ワクチンの種類, COUNT(R.vac_code) AS 予約数
    FROM Reservation AS R
    JOIN Vaccine AS V USING(vac_code)
    GROUP BY vac_code;

-- 9. 18歳未満でモデルナを接種する人★
SELECT DISTINCT R.my_num AS マイナンバー, C.name AS 名前,
    TIMESTAMPDIFF(YEAR, C.birth, CURDATE()) AS 年齢
    FROM Reservation AS R
    JOIN Citizen AS C USING(my_num)
    WHERE TIMESTAMPDIFF(YEAR, C.birth, CURDATE()) < 18 
    AND R.vac_code = 'V02';

-- 10. 2021/6/2の守谷病院における予約者情報★
SELECT R.res_date AS 接種日, R.res_time AS 接種時間, R.my_num AS マイナンバー,
    C.name AS 氏名, C.birth AS 生年月日, 
    TIMESTAMPDIFF(YEAR, C.birth, CURDATE()) AS 年齢, C.sex AS 性別,
    CONCAT(R.count, '回目') AS 接種回数, V.vac_name AS ワクチンの種類
    FROM Reservation AS R
    JOIN Citizen AS C USING(my_num)
    JOIN Vaccine AS V USING(vac_code)
    WHERE R.res_date = '2021-06-02'
    AND R.site_code = 'S0002';


SELECT res_time, COUNT(*) FROM Reservation
    WHERE res_date = '2021-06-02' AND res_time = '11:00:00';