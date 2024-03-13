// Carrega os dados do arquivo CSV
d3.csv("/DOC_Analysis/files/json/grafico04.csv").then(function(data) {
    // Converte os valores do CSV para números, se necessário
    data.forEach(d => {
        d.Value = +d.Value; // Converte para número
    });

    // Largura e altura da página
    const width = window.innerWidth;
    const height = window.innerHeight;

    // Cria a escala para os raios das bolhas
    const radiusScale = d3.scaleSqrt()
        .domain([0, d3.max(data, d => d.Value)])
        .range([5, Math.min(width, height) / 8]); // Define o intervalo dos raios

    // Cria a escala de cores alternadas
    const colorScale = d3.scaleOrdinal()
        .domain(data.map(d => d.Termo))
        .range(d3.schemeCategory10);

    // Cria a simulação de força para as bolhas
    const simulation = d3.forceSimulation(data)
        .force("x", d3.forceX().strength(0.05).x(width / 2))
        .force("y", d3.forceY().strength(0.05).y(height / 2))
        .force("collide", d3.forceCollide(d => radiusScale(d.Value) + 2))
        .on("tick", update);

    // Cria o elemento SVG
    const svg = d3.select("#chart")
        .append("svg")
        .attr("width", width)
        .attr("height", height)
        .call(d3.zoom().scaleExtent([1, 8]).on("zoom", zoomed))
        .append("g")
        .attr("class", "zoom-layer"); // Adiciona uma camada para eventos de zoom

    // Adiciona as bolhas ao SVG
    const bubbles = svg.selectAll(".bubble")
        .data(data)
        .enter()
        .append("circle")
        .attr("class", "circle")
        .attr("r", d => radiusScale(d.Value))
        .attr("fill", d => colorScale(d.Termo))
        .on("mouseover", showTooltip)
        .on("mouseout", hideTooltip)
        .on("click", clickBubble); // Adiciona evento de clique

    // Adiciona os textos dentro das bolhas
    const labels = svg.selectAll(".label")
        .data(data)
        .enter()
        .append("text")
        .attr("class", "label")
        .attr("text-anchor", "middle")
        .attr("dy", "0.35em")
        .style("font-size", "12px")
        .style("visibility", "hidden") // Inicialmente oculta os textos
        .style("pointer-events", "none") // Impede eventos de mouse para que não afetem o hover da bolha
        .text(d => `${d.Termo} -  ${d.Value}`); // Adiciona o valor (Value) após o termo

    // Adiciona a tooltip
    const tooltip = d3.select("body")
        .append("div")
        .attr("class", "tooltip");

    // Fora do bloco .then
    let clickedNode; // Variável para armazenar a bolha clicada

    function update() {
        bubbles.attr("cx", d => d.x)
            .attr("cy", d => d.y);

        labels.attr("x", d => d.x)
            .attr("y", d => d.y);
    }

    function showTooltip(event, d) {
        // Aumenta o tamanho da bolha
        d3.select(this).transition()
            .duration(200)
            .attr("r", d => (d === clickedNode ? radiusScale(d.Value) * 1.5 : radiusScale(d.Value)))
            .style("opacity", d => (d === clickedNode ? 1 : 0.7));

        const tooltipText = `${d.Termo}\nFrequência: ${d.Value}`;
        tooltip.html(tooltipText)
            .style("top", event.pageY - 10 + "px")
            .style("left", event.pageX + 10 + "px")
            .style("opacity", 1);
    }

    function hideTooltip(d) {
        // Reduz o tamanho da bolha ao tamanho original
        d3.select(this).transition()
            .duration(200)
            .attr("r", d => radiusScale(d.Value))
            .style("opacity", 0.7);

        tooltip.style("opacity", 0);
    }

    function clickBubble(event, d) {
        // Afasta as demais bolhas
        bubbles.transition()
            .duration(500)
            .attr("r", d => (d === clickedNode ? radiusScale(d.Value) * 1.5 : radiusScale(d.Value) * 1.2))
            .style("opacity", d => (d === clickedNode ? 1 : 0.7));
    
        // Torna os textos visíveis apenas para a bolha clicada
        labels.style("visibility", d => (d === clickedNode ? "hidden" : "visible")); // Invertido em relação ao código anterior
    
        // Adiciona força de repulsão entre bolhas
        simulation.force("charge", d3.forceManyBody().strength(d => (d === clickedNode ? -300 : -20)));
    
        // Define a bolha clicada
        clickedNode = d;
    
        // Reinicia a simulação de força
        simulation.alpha(0.8).restart();
    }


    function zoomed() {
        // Atualiza a transformação para permitir o zoom
        svg.attr("transform", d3.event.transform);

        // Ajusta o raio das bolhas durante o zoom
        bubbles.attr("r", d => radiusScale(d.Value) / d3.event.transform.k);
    }
});
