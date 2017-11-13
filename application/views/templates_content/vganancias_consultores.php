<?php if ($data) { ?>
    <table >
        <thead>
            <tr >
                <th ><?php echo "Ganancia de los Consultores" ?></th>
                
            </tr>
        </thead>
        <tbody>
            <?php

            var_dump($data);

            /*foreach ($data as $d) {
                
                $co_usuario = $r->co_usuario;
                $no_usuario = $r->no_usuario;
            */
                ?>
                <tr>
                    <td><?= //$no_usuario; ?></td>
                    
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php
} else {
    echo $notfound;
}

?>
