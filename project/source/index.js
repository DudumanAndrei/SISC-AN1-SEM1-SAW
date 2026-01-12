var magazin = null;

window.onload = function() {	
    init();
};

function init() {
    console.log("Magazinul PetShop este pregătit!");
    magazin = new Produse();
    magazin.read();
}