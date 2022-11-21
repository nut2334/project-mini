<?php
$pdo = new PDO("mysql:host=localhost;dbname=telephone;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<html>
    <head>
        <mega charset="utf-8">
    </head>
    <body>
        <?php $stmt = $pdo->prepare("SELECT * from branch");
            $stmt->execute();
            $location=array(
            "!1m18!1m12!1m3!1d3875.437314556709!2d100.51234531489507!3d13.752481200982785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2993961d7acc7%3A0x90495f188ff2fa5c!2sPlabplachai%20Post%20Office!5e0!3m2!1sth!2sth!4v1667040419592!5m2!1sth!2sth",
            "!1m18!1m12!1m3!1d3876.0557689896996!2d100.59019686489478!3d13.71507215183854!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29fb94f9d277f%3A0x2f13687bbaeeb210!2zMTU3MywgNSDguIvguK3guKIg4Liq4Li44LiC4Li44Lih4Lin4Li04LiXIDY5IOC5geC4guC4p-C4hyDguJ7guKPguLDguYLguILguJnguIfguYDguKvguJnguLfguK0g4LmA4LiC4LiV4Lin4Lix4LiS4LiZ4LiyIOC4geC4o-C4uOC4h-C5gOC4l-C4nuC4oeC4q-C4suC4meC4hOC4oyAxMDExMA!5e0!3m2!1sth!2sth!4v1667040459281!5m2!1sth!2sth",
            "!1m18!1m12!1m3!1d62019.30636598944!2d100.46512473124999!3d13.7059306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29f4b601951f5%3A0x51ff3e6361dbaf27!2z4LmE4Lib4Lij4Lip4LiT4Li14Lii4LmM4LmE4LiX4LiiIOC4quC4suC4guC4suC4ouC4suC4meC4meC4suC4p-C4sg!5e0!3m2!1sth!2sth!4v1667040512009!5m2!1sth!2sth",
            "!1m18!1m12!1m3!1d3877.047637017375!2d100.51871831489439!3d13.65486620321109!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2a263ed457517%3A0xb7d5a372a475e0b3!2z4LmE4Lib4Lij4Lip4LiT4Li14Lii4LmM4LmE4LiX4LiiIOC4quC4suC4guC4suC4nuC4o-C4sOC4m-C4o-C4sOC5geC4lOC4hw!5e0!3m2!1sth!2sth!4v1667040543038!5m2!1sth!2sth",
            "!1m18!1m12!1m3!1d3876.8217404011543!2d100.5031071648944!3d13.668600902898415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2a245233ac56d%3A0x1a26e032f01cced9!2z4LmE4Lib4Lij4Lip4LiT4Li14Lii4LmM4LmE4LiX4LiiIOC4quC4suC4guC4suC4o-C4suC4qeC4juC4o-C5jOC4muC4ueC4o-C4k-C4sA!5e0!3m2!1sth!2sth!4v1667040575166!5m2!1sth!2sth",
            "!1m18!1m12!1m3!1d3876.5487647664063!2d100.44303061489454!3d13.685180002520708!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2a2ae9fcf1ff7%3A0xd3467a40fd8bde25!2z4LiX4Li14LmI4LiX4Liz4LiB4Liy4Lij4LmE4Lib4Lij4Lip4LiT4Li14Lii4LmMIOC4muC4suC4h-C4guC4uOC4meC5gOC4l-C4teC4ouC4mQ!5e0!3m2!1sth!2sth!4v1667040601309!5m2!1sth!2sth",
            "!1m18!1m12!1m3!1d31009.204848120367!2d100.352732115625!3d13.709326800000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2963057040673%3A0xd1c4128f52dc157d!2z4LiX4Li14LmI4LiX4Liz4LiB4Liy4Lij4LmE4Lib4Lij4Lip4LiT4Li14Lii4LmM4Lig4Liy4Lip4Li14LmA4LiI4Lij4Li04LiN!5e0!3m2!1sth!2sth!4v1667040629750!5m2!1sth!2sth",
            "!1m18!1m12!1m3!1d3874.779794625616!2d100.36588551489527!3d13.792144100073058!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2914bc39fc639%3A0xc7941ef5e521a854!2s49!5e0!3m2!1sth!2sth!4v1667040674013!5m2!1sth!2sth",
            "!1m18!1m12!1m3!1d3875.3476027382344!2d100.49755591489513!3d13.757899400858665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29913395fad75%3A0x3a5c0af9c83364f1!2z4LmE4Lib4Lij4Lip4LiT4Li14Lii4LmM4LmE4LiX4LiiIOC4quC4suC4guC4suC4o-C4suC4iuC4lOC4s-C5gOC4meC4tOC4mQ!5e0!3m2!1sth!2sth!4v1667040696304!5m2!1sth!2sth",
            "!1m18!1m12!1m3!1d3873.1726981422134!2d100.56992251489599!3d13.888619797849898!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e28320e086ad41%3A0x8b4e3626cbcc9e1!2z4LiX4Li14LmI4LiX4Liz4LiB4Liy4Lij4LmE4Lib4Lij4Lip4LiT4Li14Lii4LmM4Lir4Lil4Lix4LiB4Liq4Li14LmI!5e0!3m2!1sth!2sth!4v1667040724068!5m2!1sth!2sth");
            $i=0;?>
            <div>สาขาทั้งหมด</div>
            <table border="1" class="branch-table">
                <tr>
                    <th>สาขา</th>
                    <th>ที่อยู่</th>
                    <th>แผนที่</th>
                    <th>เบอร์ติดต่อ</th>
                </tr>
            <?php while($row=$stmt->fetch()){ ?>
                <tr>
                    <td><?=$row["branch_id"]?></td>
                    <td><?=$row["branch_address"]?></td>
                    <td><iframe src="https://www.google.com/maps/embed?pb=<?=$location[$i]?>"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe></td>
                    <td><?=$row["branch_tel"]?></td>
                </tr>
                <?php $i++;
            }?>
            </table>
    </body>
</html>