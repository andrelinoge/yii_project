<?
    /** @var $testimonial BaseTestimonial */
    /** @var $answer BaseTestimonialAnswer */
?>

<?=  $testimonial->content; // текст відгуку?>
<?= $answer->content; // текст відповіді?>

<a href="<?= ProductsFactory::getProductShowPage($testimonial->getProduct());?>">Просмтор страници товара</a>