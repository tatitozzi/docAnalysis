// Define as dimensões do gráfico
const width = 1500;
const height = 900;

// Cria o elemento SVG
const svg = d3.select("#grafico")
  .append("svg")
  .attr("width", width)
  .attr("height", height);

// Define a paleta de cores
const colorScale = d3.scaleOrdinal(d3.schemeCategory10);

// Define a escala do tamanho das palavras
const scale = d3.scaleSqrt().range([10, 500]);

// Carrega os dados do arquivo JSON
d3.json("dados.json").then(function(data) {

  // Define o domínio da escala com base nos valores dos dados
  scale.domain([0, d3.max(data, d => d.value)]);

  // Calcula o tamanho das palavras com base nos valores dos dados
  const layout = d3.layout.cloud()
    .size([width, height])
    .words(data.map(d => ({text: d.name, size: scale(d.value), value: d.value})))
    .padding(5)
    .rotate(() => ~~(Math.random() * 2) * 90)
    .fontSize(d => d.size)
    .on("end", desenhar);

  // Inicia o layout
  layout.start();

  // Desenha as palavras na nuvem
  function desenhar(words) {
    const text = svg.selectAll(".word")
      .data(words)
      .join("text")
      .attr("class", "word")
      .attr("text-anchor", "middle")
      .attr("transform", d => `translate(${d.x},${d.y})rotate(${d.rotate})`)
      .style("font-size", d => `${d.size}px`)
      .style("fill", (d, i) => colorScale(i))
      .text(d => d.text);

    // Adiciona eventos de mouse para exibir a frequência do termo
    text.on("mouseover", (event, d) => {
        tooltip.text(`Termo: ${d.text}\nFrequência: ${d.value}`);
        tooltip.style("visibility", "visible");
      })
      .on("mousemove", (event) => {
        tooltip.style("top", `${event.pageY - 10}px`)
          .style("left", `${event.pageX + 10}px`);
      })
      .on("mouseout", () => {
        tooltip.style("visibility", "hidden");
      });

    // Adiciona a tooltip
    const tooltip = d3.select("#grafico")
      .append("div")
      .attr("class", "d3-tip")
      .style("visibility", "hidden");
  }

});
