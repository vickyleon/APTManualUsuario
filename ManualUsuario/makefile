manuales: solicitante encargado admin

solicitante: manual_solicitante.tex
	mkdir -p tmp
	pdflatex --output-dir tmp $<

encargado: manual_encargado.tex
	mkdir -p tmp
	pdflatex --output-dir tmp $<

admin: manual_administrador.tex
	mkdir -p tmp
	pdflatex --output-dir tmp $<

apoyoTecnico: indexApoyoTecnico.tex
	mkdir -p tmp
	pdflatex --output-dir tmp $<

clean:
	rm *.pdf &
	rm tmp/*