DROP TABLE IF EXISTS G06_DonneesClimatiques;
DROP TABLE IF EXISTS G06_StationMeteo;
DROP TABLE IF EXISTS G06_Villes;

-- Création de la table G06_Villes

CREATE TABLE G06_Villes (
    vil_id SERIAL PRIMARY KEY, -- Clé primaire auto-incrémentée
    vil_nom VARCHAR(50) NOT NULL UNIQUE,
    vil_departement VARCHAR(3) NOT NULL,
    vil_region VARCHAR(50) CHECK (vil_region IN ('Auvergne-Rhône-Alpes', 'Bourgogne-Franche-Comté', 'Bretagne', 
    'Centre-Val de Loire', 'Corse', 'Grand-Est', 'Guadeloupe', 'Guyane', 'Hauts-de-France', 'Île-de-France', 
    'La Réunion', 'Martinique', 'Mayotte', 'Normandie', 'Nouvelle-Aquitaine', 'Occitanie', 'Pays de la Loire', 
    'Provence-Alpes-Côte-d-Azur'))
);

-- Création de la table G06_StationMeteo

CREATE TABLE G06_StationMeteo (
    station_id SERIAL PRIMARY KEY, -- Clé primaire auto-incrémentée
    station_nom VARCHAR(50) NOT NULL,
    station_altitude INT NOT NULL,
    vil_id INT,
    FOREIGN KEY (vil_id) REFERENCES G06_Villes(vil_id) -- Clé étrangère de G06_Villes
);

-- Création de la table G06_DonneesClimatiques

CREATE TABLE G06_DonneesClimatiques (
    dc_id SERIAL PRIMARY KEY, 
    dc_tempMax FLOAT NOT NULL,
    dc_tempMin FLOAT NOT NULL,
    dc_precipitation FLOAT NOT NULL,
    dc_ensoleillement INTERVAL DEFAULT '00:00:00', 
    dc_rafales FLOAT NOT NULL,
    dc_date DATE NOT NULL,
    station_id INT,
    FOREIGN KEY (station_id) REFERENCES G06_StationMeteo(station_id) -- Clé étrangère de G06_StationMeteo
);

-- Alimentation des tables

INSERT INTO G06_Villes(vil_nom, vil_departement, vil_region)
    VALUES  ('Paris', '75', 'Île-de-France'),
            ('Marseille', '13', 'Provence-Alpes-Côte-d-Azur'),
            ('Lyon', '69', 'Auvergne-Rhône-Alpes'),
            ('Toulouse', '31', 'Occitanie'),
            ('Nice', '06', 'Provence-Alpes-Côte-d-Azur');
            
         
         
--Insertion des stations des villes 
INSERT INTO G06_StationMeteo(station_nom, station_altitude, vil_id)
    VALUES  ('PARIS-MONTSOURIS',75, (SELECT vil_id FROM G06_Villes WHERE vil_nom = 'Paris')),
            ('PARIS-Porte-de-Vincennes', 65,(SELECT vil_id FROM G06_Villes WHERE vil_nom = 'Paris')),
            ('MARSEILLE-Marignane',5,(SELECT vil_id FROM G06_Villes WHERE vil_nom = 'Marseille')),
            ('LYON-BRON',198,(SELECT vil_id FROM G06_Villes WHERE vil_nom = 'Lyon')),
            ('LYON-07', 169,(SELECT vil_id FROM G06_Villes WHERE vil_nom = 'Lyon')),
            ('LYON-ST-EXUPERY',235,(SELECT vil_id FROM G06_Villes WHERE vil_nom = 'Lyon')),
            ('TOULOUSE-BLAGNAC',152,(SELECT vil_id FROM G06_Villes WHERE vil_nom = 'Toulouse')),
            ('NICE-Cote-d''azur',2,(SELECT vil_id FROM G06_Villes WHERE vil_nom = 'Nice'));
            

--Insertion des données climatiques  de chaque station
INSERT INTO G06_DonneesClimatiques(dc_tempMax, dc_tempMin,dc_precipitation,dc_ensoleillement,dc_rafales,dc_date,station_id)
    VALUES
    --les données climatiques  insérés sont du 1-11-2023 -> 7-11-2023
    (14.2,11.2,10.2,'1:21:00',57.6,'2023-11-01',(SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'PARIS-MONTSOURIS')),
    (14.4,10.4,0.2,'5:53:00',102.2,'2023-11-02',(SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'PARIS-MONTSOURIS')),
    (10.5,5.9,1.2,'1:59:00',43.2,'2023-11-03',(SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'PARIS-MONTSOURIS')),
    (15.0,7.7,10.7,'1:49:00',72.7,'2023-11-04',(SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'PARIS-MONTSOURIS')),
    (14.7,10.4,0.8,'2:53:00',64.8,'2023-11-05',(SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'PARIS-MONTSOURIS')),
    (14.6,8.5,0.4,'4:22:00',50.4,'2023-11-06',(SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'PARIS-MONTSOURIS')),
    (13.0,7.5,0.0,'6:27:00',57.6,'2023-11-07',(SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'PARIS-MONTSOURIS')),
    
    (14.7, 11.6, 9.0, '01:00:00', 32.2, '2023-11-01', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'PARIS-Porte-de-Vincennes')),
    (14.7, 10.9, 0.2, '01:00:00', 59.5, '2023-11-02', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'PARIS-Porte-de-Vincennes')),
    (10.7, 7.0, 1.0, '01:19:00', 27.4, '2023-11-03', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'PARIS-Porte-de-Vincennes')),
    (15.5, 9.0, 10.0, '01:10:00', 40.2, '2023-11-04', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'PARIS-Porte-de-Vincennes')),
    (15.3, 11.0, 2.0, '03:00:00', 43.5, '2023-11-05', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'PARIS-Porte-de-Vincennes')),
    (14.7, 9.4, 1.0, '04:19:00', 32.2, '2023-11-06', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'PARIS-Porte-de-Vincennes')),
    (13.9, 8.6, 0.0, '05:30:00', 27.4, '2023-11-07', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'PARIS-Porte-de-Vincennes')),
    
    (20.8, 11.4, 0.0, '01:51:00', 50.4, '2023-11-01', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'MARSEILLE-Marignane')),
    (20.3, 12.8, 3.0, '00:05:00', 84.2, '2023-11-02', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'MARSEILLE-Marignane')),
    (13.6, 9.8, 0.6, '02:14:00', 61.2, '2023-11-03', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'MARSEILLE-Marignane')),
    (18.1, 6.8, 0.8, '00:36:00', 54.0, '2023-11-04', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'MARSEILLE-Marignane')),
    (18.9, 9.5, 0.0, '08:51:00', 58.3, '2023-11-05', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'MARSEILLE-Marignane')),
    (16.5, 8.3, 0.2, '02:49:00', 32.4, '2023-11-06', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'MARSEILLE-Marignane')),
    (15.6, 5.2, 0.0, '09:11:00', 29.5, '2023-11-07', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'MARSEILLE-Marignane')),
    
    (16.1, 5.3, 1.0, '00:15:00', 57.6, '2023-11-01', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'LYON-BRON')),
    (14.5, 10.4, 12.4, '06:10:00', 86.4, '2023-11-02', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'LYON-BRON')),
    (13.1, 6.0, 2.0, '03:37:00', 36.7, '2023-11-03', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'LYON-BRON')),
    (12.7, 7.9, 7.5, '00:48:00', 100.8, '2023-11-04', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'LYON-BRON')),
    (16.2, 10.8, 0.8, '02:10:00', 52.1, '2023-11-05', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'LYON-BRON')),
    (16.1, 9.7, 0.0, '02:37:00', 43.2, '2023-11-06', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'LYON-BRON')),
    (14.0, 7.1, 0.0, '03:38:00', 25.0, '2023-11-07', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'LYON-BRON')),
    
    (16.6, 7.3, 1.5, '01:10:00', 46.7, '2023-11-01', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'LYON-07')),
    (16.6, 11.3, 8.9, '00:30:00', 59.5, '2023-11-02', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'LYON-07')),
    (12.9, 6.8, 2.3, '03:00:00', 29.0, '2023-11-03', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'LYON-07')),
    (13.4, 9.0, 9.9, '01:50:00', 80.5, '2023-11-04', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'LYON-07')),
    (17.9, 9.4, 0.7, '05:40:00', 38.6, '2023-11-05', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'LYON-07')),
    (16.7, 10.0, 0.0, '02:00:00', 29.0, '2023-11-06', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'LYON-07')),
    (14.7, 7.0, 0.5, '03:00:00', 14.5, '2023-11-07', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'LYON-07')),
    
    (16.1, 7.5, 2.0, '00:58:00', 64.8, '2023-11-01', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'LYON-ST-EXUPERY')),
    (14.5, 10.0, 15.7, '01:32:00', 72.7, '2023-11-02', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'LYON-ST-EXUPERY')),
    (12.4, 7.0, 2.2, '06:59:00', 36.4, '2023-11-03', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'LYON-ST-EXUPERY')),
    (13.5, 8.4, 9.6, '01:50:00', 90.0, '2023-11-04', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'LYON-ST-EXUPERY')),
    (15.7, 10.5, 0.6, '02:10:00', 58.7, '2023-11-05', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'LYON-ST-EXUPERY')),
    (15.1, 10.4, 0.0, '03:00:00', 43.2, '2023-11-06', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'LYON-ST-EXUPERY')),
    (14.1, 8.0, 0.0, '03:38:00', 25.2, '2023-11-07', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'LYON-ST-EXUPERY')),
    
    (14.8, 7.0, 6.6, '00:58:00', 55.1, '2023-11-01', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'TOULOUSE-BLAGNAC')),
    (14.2, 9.2, 9.9, '00:28:00', 68.4, '2023-11-02', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'TOULOUSE-BLAGNAC')),
    (10.8, 7.0, 12.3, '01:32:00', 94.7, '2023-11-03', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'TOULOUSE-BLAGNAC')),
    (13.7, 8.1, 12.6, '00:08:00', 47.5, '2023-11-04', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'TOULOUSE-BLAGNAC')),
    (17.4, 7.9, 2.0, '06:00:00', 66.2, '2023-11-05', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'TOULOUSE-BLAGNAC')),
    (15.8, 7.9, 0.0, '05:21:00', 43.2, '2023-11-06', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'TOULOUSE-BLAGNAC')),
    (15.3, 4.7, 0.0, '05:52:00', 23.0, '2023-11-07', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'TOULOUSE-BLAGNAC')),
    
    (18.8, 12.7, 0.0, '00:26:00', 43.2, '2023-11-01', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'NICE-Cote-d''azur')),
    (18.1, 12.5, 9.1, '00:00:00', 44.3, '2023-11-02', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'NICE-Cote-d''azur')),
    (16.2, 11.0, 0.0, '06:59:00', 68.4, '2023-11-03', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'NICE-Cote-d''azur')),
    (16.6, 8.9, 5.4, '00:35:00', 36.0, '2023-11-04', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'NICE-Cote-d''azur')),
    (18.8, 10.1, 0.0, '09:20:00', 68.4, '2023-11-05', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'NICE-Cote-d''azur')),
    (19.2, 9.8, 0.0, '09:16:00', 51.1, '2023-11-06', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'NICE-Cote-d''azur')),
    (18.6, 10.1, 0.0, '09:14:00', 58.3, '2023-11-07', (SELECT station_id FROM G06_StationMeteo WHERE station_nom = 'NICE-Cote-d''azur'));
