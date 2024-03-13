// Carrega os dados do arquivo CSV
d3.csv("grafico04.csv").then(function(data) {
    // Cria o layout da nuvem de palavras
    const layout = d3.layout.cloud()
        .size([800, 600])
        .words(data.map(d => ({ text: d.Palavra, size: +d.Frequencia })))
        .padding(5)
        .rotate(() => (Math.random() > 0.5 ? 0 : 90))
        .fontSize(d => d.size)
        .on("end", draw);

    // Gera a nuvem de palavras
    layout.start();

    // Função para desenhar a nuvem de palavras
    function draw(words) {
        const width = 800;
        const height = 600;

        // Cria o elemento SVG
        const svg = d3.select("#chart")
            .append("svg")
            .attr("width", width)
            .attr("height", height)
            .call(d3.zoom().scaleExtent([1, 8]).on("zoom", zoomed))
            .append("g")
            .attr("class", "zoom-layer"); // Adiciona uma camada para eventos de zoom

        // Adiciona as palavras à nuvem
        const wordsGroup = svg.append("g")
            .attr("transform", `translate(${width / 2},${height / 2})`)
            .selectAll("text")
            .data(words)
            .enter()
            .append("text")
            .style("font-size", d => `${d.size}px`)
            .style("fill", "#000")
            .style("cursor", "pointer")
            .attr("text-anchor", "middle")
            .attr("transform", d => `translate(${d.x},${d.y}) rotate(${d.rotate})`)
            .text(d => d.text)
            .on("mouseover", showTooltip)
            .on("mouseout", hideTooltip)
            .on("click", clickWord); // Adiciona evento de clique

        // Adiciona a tooltip
        const tooltip = d3.select("body")
            .append("div")
            .attr("class", "tooltip");

        // Fora do bloco .then
        let clickedWord; // Variável para armazenar a palavra clicada

        function showTooltip(event, d) {
            // Aumenta o tamanho da palavra
            d3.select(this).transition()
                .duration(200)
                .style("font-size", d => `${d.size * 1.5}px`)
                .style("opacity", d => (d === clickedWord ? 1 : 0.7));

            const tooltipText = `${d.text}\nFrequência: ${d.size}`;
            tooltip.html(tooltipText)
                .style("top", event.pageY - 10 + "px")
                .style("left", event.pageX + 10 + "px")
                .style("opacity", 1);
        }

        function hideTooltip(d) {
            // Reduz o tamanho da palavra ao tamanho original
            d3.select(this).transition()
                .duration(200)
                .style("font-size", d => `${d.size}px`)
                .style("opacity", 0.7);

            tooltip.style("opacity", 0);
        }

        function clickWord(event, d) {
            // Afasta as demais palavras
            wordsGroup.transition()
                .duration(500)
                .style("font-size", d => (d === clickedWord ? `${d.size * 1.5}px` : `${d.size * 1.2}px`))
                .style("opacity", d => (d === clickedWord ? 1 : 0.7));

            // Armazena a palavra clicada
            clickedWord = clickedWord === d ? null : d;
        }

        function zoomed(event) {
            // Atualiza a transformação da camada de zoom
            svg.select(".zoom-layer").attr("transform", event.transform);
        }
    }
});
