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

    if (closeTicketVerifierModalBtn) {
        closeTicketVerifierModalBtn.addEventListener(
            "click",
            hideTicketVerifierModal
        );
    }

    const ticketVerifierModal = document.getElementById("ticketVerifierModal");
    if (ticketVerifierModal) {
        ticketVerifierModal.addEventListener("click", function (event) {
            if (event.target === ticketVerifierModal) {
                hideTicketVerifierModal();
            }
        });
    }

    document.addEventListener("keydown", function (event) {
        if (
            event.key === "Escape" &&
            ticketVerifierModal &&
            !ticketVerifierModal.classList.contains("hidden")
        ) {
            hideTicketVerifierModal();
        }
    });

    if (modal) {
        modal.classList.remove("hidden");
    }

    if (closeButton) {
        closeButton.addEventListener("click", function () {
            modal.classList.add("hidden");
        });
    }

    if (modal) {
        modal.addEventListener("click", function (event) {
            if (event.target === modal) {
                modal.classList.add("hidden");
            }
        });
    }

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

    if (closeConfirmPaymentModalBtn) {
        closeConfirmPaymentModalBtn.addEventListener('click', hideConfirmPaymentModal);
    }

    const confirmPaymentModal = document.getElementById('confirmPaymentModal');
    if (confirmPaymentModal) {
        confirmPaymentModal.addEventListener('click', function(event) {
            if (event.target === confirmPaymentModal) {
                hideConfirmPaymentModal();
            }
        });
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && confirmPaymentModal && !confirmPaymentModal.classList.contains('hidden')) {
            hideConfirmPaymentModal();
        }
    });

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

});