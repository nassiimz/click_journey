function calculatePriceGeneric(config) {
    const typeTrek = document.getElementById(config.typeTrekId || 'type_trek');
    const billetAvion = document.querySelector('input[name="billet_avion"]:checked');
    const nbPersonnes = document.getElementById(config.nbPersonnesId || 'nb_personnes');
    const totalPriceDiv = document.getElementById(config.totalPriceId || 'total-price');

    if (!typeTrek || !totalPriceDiv) return;

    // Ne rien afficher si le type de trek n'est pas sélectionné
    if (!typeTrek.value) {
        totalPriceDiv.textContent = '0 €';
        return;
    }

    // Prix de base selon le type de trek (doit être passé dans config)
    let basePrice = config.basePrices[typeTrek.value] || 0;

    // Prix billet avion
    let flightPrice = 0;
    if (billetAvion && billetAvion.value === 'avec_agence') {
        flightPrice = config.flightPrice || 0;
    }

    // Calcul du total
    const personnes = nbPersonnes ? parseInt(nbPersonnes.value) : 1;
    const total = (basePrice + flightPrice) * personnes;

    // Formatage
    const formattedTotal = 'Prix total : ' + total.toLocaleString('fr-FR') + ' €';
    totalPriceDiv.textContent = formattedTotal;
}

function setupPriceCalculation(config) {
    document.addEventListener('DOMContentLoaded', function () {
        const typeTrek = document.getElementById(config.typeTrekId || 'type_trek');
        const nbPersonnes = document.getElementById(config.nbPersonnesId || 'nb_personnes');
        if (!typeTrek || !nbPersonnes) return;

        calculatePriceGeneric(config);
        typeTrek.addEventListener('change', () => calculatePriceGeneric(config));
        document.querySelectorAll('input[name="billet_avion"]').forEach(radio => {
            radio.addEventListener('change', () => calculatePriceGeneric(config));
        });
        nbPersonnes.addEventListener('change', () => calculatePriceGeneric(config));
    });
}