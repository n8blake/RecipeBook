
-- // RETURN LIST OF ENTIRE TREE BY ORG_NAME

SELECT node.org_name
FROM organizations AS node,
        organizations AS parent
WHERE node.lft BETWEEN parent.lft AND parent.rgt
        AND parent.org_name = 'N1'
ORDER BY node.lft;

SELECT CONCAT( REPEAT(' ', COUNT(parent.org_name) - 1), node.org_name) AS name
FROM organizations AS node,
        organizations AS parent
WHERE node.lft BETWEEN parent.lft AND parent.rgt
GROUP BY node.org_name
ORDER BY node.lft;


-- // RETURN ALL THE LEAF NODES

SELECT org_name
FROM organizations
WHERE rgt = lft + 1;


-- // RETRIVING A SINGLE PATH

SELECT parent.org_name
FROM organizations AS node,
        organizations AS parent
WHERE node.lft BETWEEN parent.lft AND parent.rgt
        AND node.org_name = 'N2a-3'
ORDER BY node.lft;

SET @myCount = 0;
SELECT parent.org_name, (@myCount = @myCount + 1) as depth
FROM organizations AS node,
        organizations AS parent
WHERE node.lft BETWEEN parent.lft AND parent.rgt
        AND node.org_name = 'N2a-3'
ORDER BY node.lft;


-- // SHOW DEPTH OF NODES IN TREE

SELECT node.org_name, (COUNT(parent.org_name) - (sub_tree.depth + 1)) AS depth
FROM organizations AS node,
        organizations AS parent,
        organizations AS sub_parent,
        (
                SELECT node.org_name, (COUNT(parent.org_name) - 1) AS depth
                FROM organizations AS node,
                organizations AS parent
                WHERE node.lft BETWEEN parent.lft AND parent.rgt
                AND node.org_name = 'USS COMMAND'
                GROUP BY node.org_name
                ORDER BY node.lft
        )AS sub_tree
WHERE node.lft BETWEEN parent.lft AND parent.rgt
        AND node.lft BETWEEN sub_parent.lft AND sub_parent.rgt
        AND sub_parent.org_name = sub_tree.org_name
GROUP BY node.org_name
ORDER BY node.lft;

-- // SHOW HEIGHT OF PARENTS IN TREE

SELECT node.org_name, (COUNT(node.org_name) - (super_tree.depth + 1)) AS height
FROM organizations AS node, organizations AS parent, organizations AS super_parent,
        (
                SELECT node.org_name, (COUNT(node.org_name) + 1) AS height
                FROM organizations AS node,
                organizations AS parent
                WHERE node.lft BETWEEN parent.lft AND parent.rgt
                AND node.org_name = 'USS COMMAND'
                GROUP BY node.org_name
                ORDER BY node.lft
        ) AS super_tree
WHERE node.lft  parent.lft AND node.rgt < parent.rgt
        AND node.lft BETWEEN super_parent.lft AND sub_parent.rgt
        AND super_parent.org_name = super_tree.org_name
GROUP BY node.org_name
ORDER BY node.lft;

-- // SHOW PARENT NODES AND CHILD NODES WITH DEPTH...

(SELECT parent.org_name, ((parent.rgt - parent.lft - (node.rgt - node.lft) ) * -1) as depth
FROM organizations AS node,
        organizations AS parent
WHERE node.lft BETWEEN parent.lft AND parent.rgt
        AND node.org_name = 'N11'
ORDER BY node.lft)
UNION
(SELECT node.org_name, (COUNT(parent.org_name) - (sub_tree.depth + 1)) AS depth
FROM organizations AS node,
        organizations AS parent,
        organizations AS sub_parent,
        (
                SELECT node.org_name, (COUNT(parent.org_name) - 1) AS depth
                FROM organizations AS node,
                organizations AS parent
                WHERE node.lft BETWEEN parent.lft AND parent.rgt
                AND node.org_name = 'N11'
                GROUP BY node.org_name
                ORDER BY node.lft
        )AS sub_tree
WHERE node.lft BETWEEN parent.lft AND parent.rgt
        AND node.lft BETWEEN sub_parent.lft AND sub_parent.rgt
        AND sub_parent.org_name = sub_tree.org_name
GROUP BY node.org_name
ORDER BY node.lft);



-- // FIND THE IMMEDIATE SUBNODES OF A GIVEN NODE

SELECT node.org_name, (COUNT(parent.org_name) - (sub_tree.depth + 1)) AS depth
FROM organizations AS node,
        organizations AS parent,
        organizations AS sub_parent,
        (
                SELECT node.org_name, (COUNT(parent.org_name) - 1) AS depth
                FROM organizations AS node,
                        organizations AS parent
                WHERE node.lft BETWEEN parent.lft AND parent.rgt
                        AND node.org_name = 'N2a'
                GROUP BY node.org_name
                ORDER BY node.lft
        )AS sub_tree
WHERE node.lft BETWEEN parent.lft AND parent.rgt
        AND node.lft BETWEEN sub_parent.lft AND sub_parent.rgt
        AND sub_parent.org_name = sub_tree.org_name
GROUP BY node.org_name
HAVING depth = 1
ORDER BY node.lft; 


-- // ADD A NODE

LOCK TABLE organizations WRITE;

SELECT @myRight := rgt FROM organizations
WHERE org_name = 'N2';

UPDATE organizations SET rgt = rgt + 2 WHERE rgt > @myRight;
UPDATE organizations SET lft = lft + 2 WHERE lft > @myRight;

INSERT INTO organizations(org_name, lft, rgt) VALUES('N5', @myRight + 1, @myRight + 2);

UNLOCK TABLES;

-- // ADD NODE NEXT TO GIVEN SIBLING NODE

SET @rgt_val = (SELECT rgt FROM organizations
        WHERE org_name = 'N2');
        UPDATE organizations SET rgt = rgt + 2 WHERE rgt > @rgt_val;
        UPDATE organizations SET lft = lft + 2 WHERE lft > @rgt_val;

        INSERT INTO organizations(org_name, lft, rgt) VALUES('N5', @rgt_val + 1, @rgt_val + 2);

-- // ADD NODE UNDER A GIVEN PARENT

SET @myLeft = (SELECT lft FROM organizations
        WHERE org_name = 'N5');
UPDATE organizations SET rgt = rgt + 2 WHERE rgt > @myLeft;
UPDATE organizations SET lft = lft + 2 WHERE lft > @myLeft;

INSERT INTO organizations(org_name, lft, rgt) VALUES('N51', @myLeft + 1, @myLeft + 2);

-- EXPECTED OUTCOME: ORG N5 lft=32, rgt=33; org USS... lft=1, rgt = 34 & updated L&R for other records


-- // DELETING LEAF NODES 

SET @myOrg = 'N2a-6';
SET @myLeft := (SELECT lft FROM organizations WHERE org_name = @myOrg);
SET @myRight := (SELECT rgt FROM organizations WHERE org_name = @myOrg);
SET @myWidth := (SELECT rgt - lft + 1 FROM organizations WHERE org_name = @myOrg);

DELETE FROM organizations WHERE lft BETWEEN @myLeft AND @myRight;

UPDATE organizations SET rgt = rgt - @myWidth WHERE rgt > @myRight;
UPDATE organizations SET lft = lft - @myWidth WHERE lft > @myRight;

-- // DELETING PARENT NODES AND REASSIGNING CHILDREN TO LEVEL OF DELETED PARENT ...

SET @myOrg = 'N2a-6';
SET @myLeft := (SELECT lft FROM organizations WHERE org_name = @myOrg);
SET @myRight := (SELECT rgt FROM organizations WHERE org_name = @myOrg);
SET @myWidth := (SELECT rgt - lft + 1 FROM organizations WHERE org_name = @myOrg);

DELETE FROM organizations WHERE lft = @myLeft;

UPDATE organizations SET rgt = rgt - 1, lft = lft - 1 WHERE lft BETWEEN @myLeft AND @myRight;
UPDATE organizations SET rgt = rgt - 2 WHERE rgt > @myRight;
UPDATE organizations SET lft = lft - 2 WHERE lft > @myRight;




-- // AGGRAGET FUNCTION OF NESTED SET / FINDING COUNT OF MEMBERS PER ORG

SELECT parent.org_name, COUNT(members.MemberID)
FROM organizations AS node ,
        organizations AS parent,
        members
WHERE node.lft BETWEEN parent.lft AND parent.rgt
        AND node.orgID = members.orgID
GROUP BY parent.org_name
ORDER BY node.lft;

-- Show members of requested group

SELECT m.first_name, m.last_name, r.rank_label as rank, g.gender_label as gender
        FROM `members` m
        JOIN `ranks` r ON m.rankID=r.rankID
        JOIN `genders` g ON g.genderID=m.genderID
        JOIN `organizations` o ON o.orgID=m.orgID
        JOIN `organizations` parent ON 
WHERE o.org_name = '$_org'


