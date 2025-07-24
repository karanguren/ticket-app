document.addEventListener("DOMContentLoaded", function () {
    var modal = document.getElementById("Modal");
    var closeButton = document.getElementById("closeModalBtn");

    const openTicketVerifierModalBtn = document.getElementById(
        "openTicketVerifierModalBtn"
    );

    const closeTicketVerifierModalBtn = document.getElementById(
        "closeTicketVerifierModalBtn"
    );

    const openConfirmPaymentModalBtn = document.getElementById(
        "openConfirmPaymentModalBtn"
    );
    const closeConfirmPaymentModalBtn = document.getElementById(
        "closeConfirmPaymentModalBtn"
    );

    if (openTicketVerifierModalBtn) {
        openTicketVerifierModalBtn.addEventListener(
            "click",
            showTicketVerifierModal
        );
    }

    // Event listener para el botón de cerrar del modal de verificación de tickets
    if (closeTicketVerifierModalBtn) {
        closeTicketVerifierModalBtn.addEventListener(
            "click",
            hideTicketVerifierModal
        );
    }

    // Opcional: Cerrar el modal de verificación de tickets haciendo clic fuera de él
    const ticketVerifierModal = document.getElementById("ticketVerifierModal");
    if (ticketVerifierModal) {
        ticketVerifierModal.addEventListener("click", function (event) {
            if (event.target === ticketVerifierModal) {
                hideTicketVerifierModal();
            }
        });
    }

    // Opcional: Cerrar el modal de verificación de tickets con la tecla ESC
    document.addEventListener("keydown", function (event) {
        if (
            event.key === "Escape" &&
            ticketVerifierModal &&
            !ticketVerifierModal.classList.contains("hidden")
        ) {
            hideTicketVerifierModal();
        }
    });

    // Muestra el modal
    modal.classList.remove("hidden");

    // Cierra el modal al hacer clic en el botón de cerrar
    closeButton.addEventListener("click", function () {
        modal.classList.add("hidden");
    });

    // Cierra el modal al hacer clic fuera de él
    modal.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.classList.add("hidden");
        }
    });

    function showConfirmPaymentModal() {
        const modal = document.getElementById("confirmPaymentModal");
        if (modal) {
            modal.classList.remove("hidden");
            modal.classList.add("flex");
        }
    }

    function hideConfirmPaymentModal() {
        const modal = document.getElementById("confirmPaymentModal");
        if (modal) {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        }
    }

    if (openConfirmPaymentModalBtn) {
        openConfirmPaymentModalBtn.addEventListener('click', showConfirmPaymentModal);
    }

    // Event listener para el botón de cerrar del modal de confirmación de pago
    if (closeConfirmPaymentModalBtn) {
        closeConfirmPaymentModalBtn.addEventListener('click', hideConfirmPaymentModal);
    }
    // Opcional: Cerrar el modal de confirmación de pago haciendo clic fuera de él
    const confirmPaymentModal = document.getElementById('confirmPaymentModal');
    if (confirmPaymentModal) { 
        confirmPaymentModal.addEventListener('click', function(event) {
            if (event.target === confirmPaymentModal) {
                hideConfirmPaymentModal();
            }
        });
    }
    // Opcional: Cerrar el modal de confirmación de pago con la tecla ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && confirmPaymentModal && !confirmPaymentModal.classList.contains('hidden')) {
            hideConfirmPaymentModal();
        }
    });
});

// Variable global para rastrear el último botón clickeado
// Se inicializa en null para que no haya un botón activo al cargar la página.
let lastClickedButtonId = null;

// --- Constantes de HTML para cada método de pago (FUNCIONES) ---
// Cada constante es una función que recibe el 'monto' y devuelve el HTML.
const PAGO_MOVIL_CARD_HTML = (monto) => `
    <div class="text-center">
        <p class="mb-2 text-lg"><strong>🏦 Banco:</strong> Venezuela / Banesco</p>
        <p class="mb-2 text-lg"><strong>📱 Teléfono:</strong> <span class="text-blue-600 font-medium">0426-3068466</span></p>
        <p class="mb-2 text-lg"><strong>🪪 C.I:</strong> <span class="text-blue-600 font-medium">V-17.718.709</span></p>
        <p class="mt-4 text-sm text-gray-500">Por favor, adjunta tu comprobante.</p>
        <p class="text-slate-600 leading-normal font-light mt-4">
            Total a pagar: <span class="font-bold text-green-600">Bs. ${monto}</span>
        </p>
    </div>
`;

const ZELLE_CARD_HTML = (monto) => `
    <div class="text-center">
        <p class="mb-2 text-lg">Envía tu pago a la cuenta de Zelle:</p>
        <p class="mb-2 text-xl font-semibold text-green-700 break-words">correo@ejemplo.com</p>
        <p class="mt-4 text-sm text-gray-500">Asegúrate de incluir tu nombre en la referencia y enviar el comprobante.</p>
        <p class="text-slate-600 leading-normal font-light mt-4">
            Total a pagar: <span class="font-bold text-green-600">$ ${monto}</span>
        </p>
    </div>
`;

const BINANCE_CARD_HTML = (monto) => `
    <div class="text-center">
        <p class="mb-2 text-lg">Realiza tu pago a nuestro ID de Binance Pay:</p>
        <p class="mb-2 text-xl font-semibold text-yellow-600 break-words">1234567890</p>
        <p class="mt-4 text-sm text-gray-500">Confirma la transacción en la aplicación y envíanos el ID de la operación.</p>
        <p class="text-slate-600 leading-normal font-light mt-4">
            Total a pagar: <span class="font-bold text-green-600">USDT ${monto}</span>
        </p>
    </div>
`;

const ZINLI_CARD_HTML = (monto) => `
    <div class="text-center">
        <p class="mb-2 text-lg">Para Zinli, transfiere a nuestro usuario:</p>
        <p class="mb-2 text-xl font-semibold text-purple-600 break-words">@rifasloshermanos</p>
        <p class="mt-4 text-sm text-gray-500">Asegúrate de que la cantidad sea exacta y envía el capture.</p>
        <p class="text-slate-600 leading-normal font-light mt-4">
            Total a pagar: <span class="font-bold text-green-600">$ ${monto}</span>
        </p>
    </div>
`;

/**
 * Alterna la visibilidad de un div y actualiza su título y contenido HTML.
 *
 * @param {string} title El título a mostrar.
 * @param {string} htmlContent El contenido HTML a insertar en dynamicText.
 * @param {string} buttonId El ID del botón que activó la función.
 */
function togglePaymentInfo(title, htmlContent, buttonId) {
    const miDiv = document.getElementById("miDiv");
    const dynamicTitle = document.getElementById("dynamicTitle");
    const dynamicText = document.getElementById("dynamicText");

    // Verifica si los elementos necesarios existen en el DOM
    if (!miDiv || !dynamicTitle || !dynamicText) {
        console.error(
            "Error: Uno o más elementos del DOM ('miDiv', 'dynamicTitle', 'dynamicText') no fueron encontrados."
        );
        return; // Detiene la ejecución si faltan elementos
    }

    // Si la card ya está visible Y se hace clic en el MISMO botón, ocúltala.
    if (
        !miDiv.classList.contains("hidden") &&
        lastClickedButtonId === buttonId
    ) {
        miDiv.classList.add("hidden");
        miDiv.classList.remove("flex"); // Remueve 'flex' para que no ocupe espacio cuando está oculto
        lastClickedButtonId = null; // Reinicia el último botón clickeado
    } else {
        // Si la card está oculta O se hace clic en un botón diferente, muéstrala y actualiza el contenido.
        dynamicTitle.innerText = title;
        dynamicText.innerHTML = htmlContent; // ¡Aquí inyectamos el HTML dinámico!

        if (miDiv.classList.contains("hidden")) {
            miDiv.classList.remove("hidden");
            miDiv.classList.add("flex"); // Asegura que el flexbox se aplique para el centrado
        }
        lastClickedButtonId = buttonId; // Actualiza el último botón clickeado
    }
}

// --- Event Listeners principales para los botones de método de pago ---
// Espera a que todo el contenido del DOM esté cargado antes de ejecutar el script.
document.addEventListener("DOMContentLoaded", () => {
    // Obtener referencias a los divs de los botones (imágenes)
    const pagoMovilBtn = document.getElementById("pagoMovilBtn");
    const zelleBtn = document.getElementById("zelleBtn");
    const binanceBtn = document.getElementById("binanceBtn");
    const zinliBtn = document.getElementById("zinliBtn");

    // Monto obtenido directamente de la variable global que Laravel inyecta
    // Asegúrate de que window.totalFromLaravel esté definido en tu Blade antes de cargar este script.
    // El '|| '0.00'' es un fallback si por alguna razón la variable no está disponible.
    const totalAPagar = window.totalFromLaravel || "0.00";

    if (pagoMovilBtn) {
        pagoMovilBtn.addEventListener("click", () => {
            togglePaymentInfo(
                "Información de Pago Móvil",
                PAGO_MOVIL_CARD_HTML(totalAPagar), // Pasa el monto obtenido de Laravel
                "pagoMovilBtn"
            );
        });
    }

    if (zelleBtn) {
        zelleBtn.addEventListener("click", () => {
            togglePaymentInfo(
                "Información de Zelle",
                ZELLE_CARD_HTML(totalAPagar), // Pasa el monto obtenido de Laravel
                "zelleBtn"
            );
        });
    }

    if (binanceBtn) {
        binanceBtn.addEventListener("click", () => {
            togglePaymentInfo(
                "Información de Binance Pay",
                BINANCE_CARD_HTML(totalAPagar), // Pasa el monto obtenido de Laravel
                "binanceBtn"
            );
        });
    }

    if (zinliBtn) {
        zinliBtn.addEventListener("click", () => {
            togglePaymentInfo(
                "Información de Zinli",
                ZINLI_CARD_HTML(totalAPagar), // Pasa el monto obtenido de Laravel
                "zinliBtn"
            );
        });
    }
});

function updateText() {
    const ticketsInput = document.getElementById("tickets");
    console.log("Número de tickets:", ticketsInput.value);
}

function showTicketVerifierModal() {
    const modal = document.getElementById("ticketVerifierModal");
    if (modal) {
        modal.classList.remove("hidden");
        modal.classList.add("flex");
    }
}

function hideTicketVerifierModal() {
    const modal = document.getElementById("ticketVerifierModal");
    if (modal) {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
    }
}
