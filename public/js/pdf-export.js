document.addEventListener("DOMContentLoaded", function () {
    const pdfLinks = document.querySelectorAll('a[href*="export=pdf"]');

    pdfLinks.forEach((link) => {
        link.addEventListener("click", async function (e) {
            e.preventDefault();
            const url = this.href;

            // Mostrar loading
            document
                .querySelector(".loading-indicator")
                .classList.remove("d-none");

            try {
                // Realizar la petición fetch
                const response = await fetch(url, {
                    method: "GET",
                    headers: {
                        Accept: "application/pdf",
                    },
                });

                if (!response.ok)
                    throw new Error("Network response was not ok");

                // Obtener el blob del PDF
                const blob = await response.blob();

                // Crear URL del blob
                const downloadUrl = window.URL.createObjectURL(blob);

                // Crear link temporal y hacer click
                const a = document.createElement("a");
                a.style.display = "none";
                a.href = downloadUrl;
                a.download = "reporte.pdf"; // Nombre del archivo a descargar

                document.body.appendChild(a);
                a.click();

                // Limpiar
                window.URL.revokeObjectURL(downloadUrl);
                document.body.removeChild(a);
            } catch (error) {
                console.error("Error:", error);
                alert("Error al generar el PDF. Por favor intente nuevamente.");
            } finally {
                // Ocultar loading después de un breve delay
                setTimeout(() => {
                    document
                        .querySelector(".loading-indicator")
                        .classList.add("d-none");
                }, 1000);
            }
        });
    });
});
