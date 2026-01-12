/* Definirea clasei pentru un singur Produs */
function Produs(id, nume, categorie, pret, imagine, c1, c2, c3, c4, c5, sursa) {
    this.id = id;
    this.nume = nume;
    this.categorie = categorie;
    this.pret = pret;
    this.imagine = imagine;
    this.c1 = c1;
    this.c2 = c2;
    this.c3 = c3;
    this.c4 = c4;
    this.c5 = c5;
    this.sursa = sursa; // Folosim acest câmp pentru a vedea de unde vine (DB sau JSON)
};