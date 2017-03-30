package Compilador;

public class Simbolos {
	 String Tipo,Nombre;
	 int Linea;
	 //Constructor
		Simbolos(String tipo,String nomb,int linea){
			this.Tipo=tipo;
			this.Nombre=nomb;
			this.Linea=linea;
		}
		public void setTipo(String tipo) {
	        this.Tipo = tipo;
	    }
		public void setNombre(String nombre) {
	        this.Nombre = nombre;
	    }
		public void setLinea(int linea) {
	        this.Linea = linea;
	    }
}
