<section>
        <?php
        foreach ($cs as $c):
            if (!empty($c['Product'])) {
                ?>
                <h2><?php echo $c['Category']['name'] ?></h2>
                <?php
                foreach ($c['Product'] as $p):
                    ?>
                    <div class="product" id="<?php echo $p['id'] ?>" style="background-image: url(<?php echo $this->webroot; ?>img/photos/<?php echo $p['picture'] ?>)">
                        <div class="productBadge">0</div>
                        <div class="productContent">
                            <span class="price"><?php echo "$" . $p['price'] ?></span>
                            <h3 class="name"><?php echo $p['name'] ?></h3> 
                            <p class="description"><?php echo $p['description'] ?></p>
                        </div>
                        <div class="productMinus">-</div>
                    </div>
                <?php endforeach; ?>
                <div class="clearfix"></div>
            <?php } endforeach; ?>
    </section>