$(document).ready(function() {    
    $('#search_text_input').focus(function() {
        if(window.matchMedia( "(min-width: 800px)" ).matches) {
            $(this).animate({width: '250px'}, 500);
        }
    });
    $('#search_text_input').blur(function() {
        if(window.matchMedia( "(min-width: 800px)" ).matches) {
            $(this).animate({width: '100px'}, 500);
        }
    });
});

$(document).click(function(e){
    if(e.target.class != "search_results" && e.target.id != "search_text_input") {

		$(".search_results").html("");
		$('.search_results_footer').html("");
		$('.search_results_footer').toggleClass("search_results_footer_empty");
		$('.search_results_footer').toggleClass("search_results_footer");
    }
});

function save(id, num) {
    $.post("includes/handlers/ajax_product_save.php", {product_id:id, number:num}, function(data) {
        $(".to_save"+id).html(data);
    });
}

function unsave(id, num) {
    $.post("includes/handlers/ajax_product_unsave.php", {product_id:id, number:num}, function(data) {
        $(".to_save"+id).html(data);
    });
}

function rate(num ,id) {
    $.post("includes/handlers/ajax_product_rate.php", {number:num, product_id:id}, function(data) {
        $(".change").html(data);
    });
}

function cart(num, id) {
    $.post("includes/handlers/ajax_product_cart.php", {number:num, product_id:id}, function(data) {
        $(".cart"+id).html(data);
    });
}

function uncart(num, id) {
    $.post("includes/handlers/ajax_product_uncart.php", {number:num, product_id:id}, function(data) {
        $(".cart"+id).html(data);
    });
}

function drop(id) {
    $.post("includes/handlers/ajax_product_drop.php", {product_id:id}, function(data) {
        $(".item"+id).html(data);
    });
    $.post("includes/handlers/ajax_product_total.php", {}, function(data) {
        $(".total").html(data);
    });
}

function plus(id) {
    $.post("includes/handlers/ajax_product_plus.php", {product_id:id}, function(data) {
        $(".item"+id).html(data);
    });
    $.post("includes/handlers/ajax_product_total.php", {}, function(data) {
        $(".total").html(data);
    });
}

function getProducts(value) {

	$.post("includes/handlers/ajax_search.php", {query:value}, function(data) {

		if($(".search_results_footer_empty")[0]) {
			$(".search_results_footer_empty").toggleClass("search_results_footer");
			$(".search_results_footer_empty").toggleClass("search_results_footer_empty");
		}

		$('.search_results').html(data);
		$('.search_results_footer').html("<a href='search.php?q=" + value + "'>See All Results</a>");

		if(data == "") {
			$('.search_results_footer').html("");
			$('.search_results_footer').toggleClass("search_results_footer_empty");
			$('.search_results_footer').toggleClass("search_results_footer");
		}

	});

}
