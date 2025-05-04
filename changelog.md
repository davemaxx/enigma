# Changelog

## [1.3.0] - 2025-05-04
### Aggiunto
- Terzo rotore implementato nel sistema Enigma.
- Riflettore funzionante.
- Gestione delle posizioni iniziali da file `enigmakeysheet.php`.
- Funzioni `letteraToNumero()` per convertire lettere in posizioni numeriche.
- Validazione input lettere A-Z.
- Visualizzazione dettagliata di ogni step di cifratura.

### Corretto
- Bug nella codifica e decodifica legata alla posizione.
- Problemi di sessione risolti.

### Rimosso
- Supporto a numeri nella codifica (semplificato a lettere A-Z).

## [v1.1] - 2025-04-22
### Aggiunte
- Aggiunto secondo rotore con mappatura personalizzata
- Ogni rotore ruota indipendentemente
- Visualizzazione della lettera dopo ciascun rotore
- Visualizzazione delle posizioni dei due rotori

### Correzioni
- Corretta la logica di posizione iniziale del secondo rotore
- Sistemato errore nella visualizzazione dei risultati

## [2025-04-20]
- Iniziata la riscrittura della classe `Rotore` da zero con guida passo passo
- Aggiunta la struttura di base con proprietà e costruttore