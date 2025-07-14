CREATE DATABASE emprunts;
USE emprunts;

CREATE TABLE emprunts_membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    date_naissance DATE,
    genre VARCHAR(150),
    email VARCHAR(150),
    ville VARCHAR(100),
    mdp VARCHAR(255),
    image_profil VARCHAR(255)
);

CREATE TABLE emprunts_categorie_objet (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100)
);

CREATE TABLE emprunts_objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(100),
    id_categorie INT,
    id_membre INT,
    FOREIGN KEY (id_categorie) REFERENCES emprunts_categorie_objet(id_categorie),
    FOREIGN KEY (id_membre) REFERENCES emprunts_membre(id_membre)
);

CREATE TABLE emprunts_images_objet (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    nom_image VARCHAR(255),
    FOREIGN KEY (id_objet) REFERENCES emprunts_objet(id_objet)
);

CREATE TABLE emprunts_emprunt (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    id_membre INT,
    date_emprunt DATE,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES emprunts_objet(id_objet),
    FOREIGN KEY (id_membre) REFERENCES emprunts_membre(id_membre)
);

INSERT INTO emprunts_membre (nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
('Alice', '1990-05-12', 'Femme', 'alice@gmail.com', 'Antananarivo', 'mdpAlice', 'default.jpg'),
('Bob', '1988-11-22', 'Homme', 'bob@gmail.com', 'Toamasina', 'mdpBob', 'default.jpg'),
('Charlie', '1995-08-01', 'Homme', 'charlie@gmail.com', 'Fianarantsoa', 'mdpCharlie', 'default.jpg'),
('Dina', '2000-03-30', 'Autre', 'dina@gmail.com', 'Mahajanga', 'mdpDina', 'default.jpg');


INSERT INTO emprunts_categorie_objet (nom_categorie) VALUES
('Esthétique'),
('Bricolage'),
('Mécanique'),
('Cuisine');

INSERT INTO emprunts_objet (nom_objet, id_categorie, id_membre) VALUES
('Sèche-cheveux', 1, 1),
('Marteau', 2, 1),
('Clé à molette', 3, 1),
('Mixeur', 4, 1),
('Peigne', 1, 1),
('Tournevis', 2, 1),
('Cric', 3, 1),
('Robot de cuisine', 4, 1),
('Rouge à lèvres', 1, 1),
('Perceuse', 2, 1);

INSERT INTO emprunts_objet (nom_objet, id_categorie, id_membre) VALUES
('Lisseur', 1, 2),
('Scie', 2, 2),
('Pneu', 3, 2),
('Four', 4, 2),
('Brosse à cheveux', 1, 2),
('Couteau suisse', 2, 2),
('Filtre à huile', 3, 2),
('Casserole', 4, 2),
('Fond de teint', 1, 2),
('Visseuse', 2, 2);

INSERT INTO emprunts_objet (nom_objet, id_categorie, id_membre) VALUES
('Épilateur', 1, 3),
('Tournevis électrique', 2, 3),
('Pompe à air', 3, 3),
('Blender', 4, 3),
('Lotion', 1, 3),
('Pince multiprise', 2, 3),
('Batterie', 3, 3),
('Grille-pain', 4, 3),
('Crème visage', 1, 3),
('Marteau perforateur', 2, 3);

INSERT INTO emprunts_objet (nom_objet, id_categorie, id_membre) VALUES
('Mascara', 1, 4),
('Cloueuse', 2, 4),
('Frein à disque', 3, 4),
('Mixeur plongeant', 4, 4),
('Pinceau maquillage', 1, 4),
('Scie sauteuse', 2, 4),
('Amortisseur', 3, 4),
('Plaque induction', 4, 4),
('Crayon sourcil', 1, 4),
('Clé dynamométrique', 2, 4);

INSERT INTO emprunts_emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(2, 2, '2025-07-01', '2025-07-10'),
(5, 3, '2025-07-02', '2025-07-12'),
(8, 4, '2025-07-03', '2025-07-15'),
(12, 1, '2025-07-04', '2025-07-14'),
(16, 3, '2025-07-05','2025-07-14'),
(20, 4, '2025-07-06','2025-07-14'),
(23, 1, '2025-07-07', '2025-07-11'),
(27, 2, '2025-07-08','2025-07-14'),
(32, 1, '2025-07-09', '2025-07-13'),
(38, 2, '2025-07-10','2025-07-14');

CREATE VIEW vue_objets_emprunt AS
SELECT 
    o.id_objet,
    o.nom_objet,
    c.nom_categorie,
    m.nom AS proprietaire,
    e.date_emprunt,
    e.date_retour
FROM emprunts_objet o
JOIN emprunts_categorie_objet c ON o.id_categorie = c.id_categorie
JOIN emprunts_membre m ON o.id_membre = m.id_membre
LEFT JOIN emprunts_emprunt e 
    ON o.id_objet = e.id_objet;
