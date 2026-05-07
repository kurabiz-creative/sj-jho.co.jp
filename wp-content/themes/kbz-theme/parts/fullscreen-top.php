<?php
global $fullscreen_id, $fv, $fv_title;

$fv_img = get_field('top_fv');
?>
<section class="top-fv-wrap md:h-[calc(100dvh-(var(--header-scroll-total)))]">
    <?php if($fv_img): ?>
    <div class="fv-slider splide h-full" aria-label="TOPのファストビュー">
        <div class="splide__track h-full">
            <ul class="splide__list">
            <?php
                foreach($fv_img as $img) :
                    if(isset($img['top_fv_img']) && !empty($img['top_fv_img'])):
            ?>
                <li class="splide__slide">
                    <picture class="aspect-ratio md:aspect-[2.25/1] w-full">
                        <?php if(isset($img['top_fv_img_sp']) && !empty($img['top_fv_img_sp'])) : ?>
                        <source media="(max-width: 768px)" srcset="<?php echo esc_url($img['top_fv_img_sp']); ?>">
                        <?php endif; ?>
                        <img class="w-full h-full object-cover" src="<?php echo esc_url($img['top_fv_img']); ?>" alt="">
                    </picture>
                </li>
            <?php
                    endif;
                endforeach;
            ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>
</section>