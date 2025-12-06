$(document).ready(function() {
    let items = [];

    function getBooks() {
        $.ajax({
            url: "../includes/functions/get_items.php",
            type: "GET",
            success: function(data) {
                if (data.success) {
                    items = data.data;
                    showBooks(items);
                }
            }
        });
    }

    function showBooks(books) {
        let html = '';
        books.forEach(function(book) {
            let stock = book.stock > 0 ? 'Stock: ' + book.stock : 'Out of Stock';
            html += '<div class="card" data-id="' + book.item_id + '">';
            html += '<img src="' + book.image + '">';
            html += '<h3>' + book.item_name + '</h3>';
            html += '<p class="price">₱ ' + book.item_price + '</p>';
            html += '<p class="stock">' + stock + '</p>';
            html += '</div>';
        });
        $("#booksList").html(html);

        $(".card").click(function() {
            let id = $(this).data("id");
            let book = items.find(x => x.item_id == id);
            showModal(book);
        });
    }

    function showModal(book) {
        $("#bookImg").attr("src", book.image);
        $("#bookName").text(book.item_name);
        $("#bookPrice").text(book.item_price);
        $("#bookDesc").text(book.description || "No description");

        let stockEl = $("#bookStock");
        if (book.stock > 10) {
            stockEl.text("In Stock (" + book.stock + ")").removeClass().addClass("stock-ok");
            $("#addBtn").prop("disabled", false);
        } else if (book.stock > 0) {
            stockEl.text("Low Stock (" + book.stock + ")").removeClass().addClass("stock-low");
            $("#addBtn").prop("disabled", false);
        } else {
            stockEl.text("Out of Stock").removeClass().addClass("stock-out");
            $("#addBtn").prop("disabled", true);
        }

        $("#bookModal").show();
    }

    $(".close").click(function() {
        $("#bookModal").hide();
    });

    $(window).click(function(e) {
        if ($(e.target).is("#bookModal")) {
            $("#bookModal").hide();
        }
    });

    $("#addBtn").click(function() {
        alert("Added to cart");
        $("#bookModal").hide();
    });

    getBooks();
});