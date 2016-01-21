SELECT m.first_name, m.last_name, g.gmt_label, gmtC.completion_date 
FROM `memberGMTcompletion` gmtC
JOIN gmts g on g.gmtID=gmtC.gmtID
JOIN members m on gmtC.memberID=m.memberID
WHERE m.memberID='1'


SELECT m.first_name, m.last_name, r.rank_label as rank, g.gener_label as gender
FROM `members` m
JOIN `ranks` r ON m.rankID=r.rankID
JOIN `genders` g ON g.genderID=m.genderID

SELECT a.x, a.y
FROM table_a a LEFT JOIN table_b b
ON a.x = b.x AND a.y = b.y
WHERE b.x IS NULL;

SELECT m.first_name, m.last_name, gmtC.completion_date
FROM `members` m LEFT JOIN `memberGMTcompletion` gmtC
ON m.memberID = gmtC.memberID AND gmtC.gmtID = '1'
WHERE gmtC.completion_date IS NULL;

SELECT g.gmt_label
FROM `gmts` g
WHERE g.gmtID = '1'