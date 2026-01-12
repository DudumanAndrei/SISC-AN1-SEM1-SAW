function Produse() {
    this.id = "produse";
    this.children = [];
};

Produse.prototype.read = function () {
    console.log("Încep încărcarea produselor...");
    var self = this;
    this.children = [];
    $.ajax({
        url: "products.php?read=1",
        method: "GET",
        dataType: "json",
        cache: false
    })
        .done(function (dbData) {
            console.log("Datele din DB au fost încărcate.");
            if (dbData && dbData.items) {
                self.adaugaInLista(dbData.items, "Bază de Date");
            }
            $.ajax({
                url: "produse_petshop.json",
                method: "GET",
                dataType: "json",
                cache: false
            })
                .done(function (jsonData) {
                    console.log("Datele din JSON au fost încărcate.");
                    if (jsonData && jsonData.produse) {
                        self.adaugaInLista(jsonData.produse, "JSON");
                    }
                    self.show();
                })
                .fail(function () {
                    console.error("Fișierul JSON nu a fost găsit.");
                    self.show();
                });
        })
        .fail(function () {
            console.error("Eroare la comunicarea cu products.php");
        });
};

Produse.prototype.adaugaInLista = function (items, sursaEticheta) {
    for (var i = 0; i < items.length; i++) {
        var it = items[i];
        var p = new Produs(
            it.id || (this.children.length + 100),
            it.nume,
            it.categorie,
            it.pret,
            it.imagine,
            it.c1,
            it.c2,
            it.c3,
            it.c4,
            it.c5,
            sursaEticheta
        );
        this.children.push(p);
    }
};

Produse.prototype.show = function () {
    var container = $("#container-produse");
    container.empty();

    if (this.children.length === 0) {
        container.html('<p class="text-center">Nu s-au găsit produse în nicio sursă.</p>');
        return;
    }

    for (var i = 0; i < this.children.length; i++) {
        var p = this.children[i];
        var colorClass = (p.sursa === "JSON") ? "bg-secondary" : "bg-primary";

        var cardHTML = '<div class="col-md-4 mb-4">' +
            '<div class="card h-100 border-0 shadow-sm">' +
            '<img src="' + p.imagine + '" class="card-img-top p-2 rounded" alt="' + p.nume + '">' +
            '<div class="card-body text-center">' +
            '<h5 class="card-title text-orange">' + p.nume + ' <span class="badge ' + colorClass + '">' + p.sursa + '</span></h5>' +
            '<ul class="product-features text-muted">' +
            '<li>' + p.c1 + '</li><li>' + p.c2 + '</li><li>' + p.c3 + '</li><li>' + p.c4 + '</li><li>' + p.c5 + '</li>' +
            '</ul>' +
            '<p class="fw-bold fs-5">' + p.pret + ' RON</p>' +
            '<button class="btn btn-sm btn-outline-danger" onclick="magazin.deleteProdus(' + p.id + ')">Șterge</button>' +
            '</div>' +
            '</div>' +
            '</div>';

        container.append(cardHTML);
    }
};

Produse.prototype.deleteProdus = function (id) {
    if (confirm("Dorești să elimini acest produs din vizualizarea curentă?")) {
        this.children = this.children.filter(function (c) { return c.id !== id; });
        this.show();
    }
};