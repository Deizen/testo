package Compilador;
import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.io.IOException;
import java.util.StringTokenizer;
import java.util.Vector;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import javax.swing.JOptionPane;

public class scanner {
	 String Nombre,Identificador;
	 int Linea;
	 //Constructor
		scanner (String nomb,String ident,int line){
			this.Nombre=nomb;
			this.Identificador=ident;
			this.Linea=line;
		}
		//Tipos de Variables
		static Vector<scanner> Tokens=new Vector<scanner>();
		String Tipo[]={"int","boolean"};
		String Operadores[]={"==","+"};
		String PalabraReservada[]={"void","main","class","if","else","System.out.println","true","return","extends","="};
		String Llaves[]={"{","}","(",")",";",","};
		int error=0;
		static int posicion=-1,pos=-1;
		boolean Invalido=false;
		  //Metodos
				public static boolean EsIdentificador(String token){
				 Pattern patron = Pattern.compile("^([a-z]|[A-Z])([a-z]|[A-Z]|[0-9])*");
		         Matcher mat = patron.matcher(token);
		         if(mat.matches())
		             return true;
		         return false;
				}
				public static boolean EsNumero(String numero){
					if (numero.matches("[0-9]*"))	
			 			return true;
			 		return false;
				}	
		public String scannerT(File texto){	
			int linea=0;	
	        String msj="",aux;
	       try
	       {
			if(texto!=null)
		      {    
		         FileReader archivos=new FileReader(texto);
		         BufferedReader leer=new BufferedReader(archivos);
		         while((aux=leer.readLine())!=null)
		         {
		        	linea=linea+1;
		        	StringTokenizer st = new StringTokenizer(aux);
		        	while(st.hasMoreTokens())
		        	{
		   	    	 String token=st.nextToken();
		   	    	 boolean flagP=false,flagT=false,flagO=false,flagL=false;
			    	 //verifica la sentencia 
			    	 for(int x=0;x<PalabraReservada.length;x++){
				         if(token.compareTo(PalabraReservada[x])==0){
				        	 Tokens.add(new scanner(token,"Palabra Reservada",linea));
				        	 flagP=true;
				        	 break;
				         	}
				         } //Verifica el tipo de variable
			    	 for(int x=0;x<Tipo.length;x++){
			         if(token.compareTo(Tipo[x])==0){
			        	 Tokens.add(new scanner(token,"Tipo",linea));
			        	 flagT=true;
			        	 break;
			         	}
			    	 }//Verifica si es operador
			    	 for(int x=0;x<Operadores.length;x++){
			         if(token.compareTo(Operadores[x])==0){
			        	 Tokens.add(new scanner(token,"Operador",linea));
			        	 flagO=true;
			        	 break;
			         	}
			         } //Verifica si es una Llave
			    	 for(int x=0;x<Llaves.length;x++){
				         if(token.compareTo(Llaves[x])==0){
				        	 Tokens.add(new scanner(token,"Llave",linea));
				        	 flagL=true;
				        	 break;
				         	}
				         } //Verifica si es numero
			         if(EsNumero(token)){
			        	 Tokens.add(new scanner(token,"Numerico",linea));	 
			        	 continue;
			         }
			         //Verificar si es un Identificador
			         if (EsNumero(token)==false && flagT==false && flagO==false && flagP==false && flagL==false)
			        	if(EsIdentificador(token)){
			        		Tokens.add(new scanner(token,"Identificador",linea));
			        		continue;
			        	}else{
			        	 Invalido=true;
			        	 error++;
			        	 if(error==1){
			        		 Grafico.resultado.setText("Error Lexico en el Token "+ token+" en la Linea: "+linea+", Token Invalido.");
			        	 	}
			        	 }         
		        	}
		        	msj=msj+ aux+ "\n";
		         }  
		         leer.close();
		      } 
	       }catch(IOException ex) {
	  	     JOptionPane.showMessageDialog(null,ex+"" +
	  	       "\nNo se ha encontrado el archivo",
	  	       "Advertencia",JOptionPane.WARNING_MESSAGE);
	       }
	       return msj;       
		}
		public scanner getNextToken(){
			try{
				posicion++;
				return Tokens.elementAt(posicion);	
			}catch(ArrayIndexOutOfBoundsException e){
				return new scanner("Faltan tokens","falso",Tokens.elementAt(Tokens.size()-1).Linea);
			}
		}
		public scanner NextToken(){
			try{
				pos=(posicion+1);
				return Tokens.elementAt(pos);	
			}catch(ArrayIndexOutOfBoundsException e){
				return new scanner("Faltan tokens","falso",Tokens.elementAt(Tokens.size()-1).Linea);
			}
		}
}
