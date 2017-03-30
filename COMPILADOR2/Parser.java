package Compilador;

import java.util.Vector;

public class Parser {
	static scanner token= new scanner("","",0);
	static scanner temporal= new scanner("","",0);
	static Vector<scanner> ArbolParsing=new Vector<scanner>();
	static Vector<scanner> ArbolSintactico=new Vector<scanner>();
	static boolean Noexiste=false,Merror=false;
	static int Ierror=0, adv=0;
	static String resultado=null;
	static JavaByteCode JBC=new JavaByteCode(); 
	static Vector<Simbolos> extend=new Vector<Simbolos>();
	static Vector<Simbolos> TablaClases=new Vector<Simbolos>();
	static Vector<Simbolos> TablaMetodos=new Vector<Simbolos>();
	static Vector<Simbolos> TablaParametros=new Vector<Simbolos>();
	static Vector<Simbolos> TablaLocalesClase=new Vector<Simbolos>();
	static Vector<Simbolos> TablaLocalesMetodo=new Vector<Simbolos>();
	
	public static void advance(){		
		token=temporal.getNextToken();
		if(token.Identificador.compareTo("falso")==0) //verifica ultimo token
		 Noexiste=true;	
	}
	public boolean eat(String T){
		if(token.Nombre.compareTo(T)==0){
			ArbolParsing.add(token);
			return true;
		}		
		else	
			error(token);				
		return false;
	}
	public boolean EsIdentificador(){
        if(token.Identificador.compareTo("Identificador")==0){
           ArbolParsing.add(token);
        	return true;
        }
			return false; 	
		}
	public static boolean EsNumero(String numero){
        if(token.Identificador.compareTo("Numerico")==0){
           ArbolParsing.add(token);
        	return true;
        }
        return false; 
	}
	public static void error(scanner token){
		Ierror++;
		if(Ierror==1){ //Se queda con el primer error
		if(!(token.Identificador.compareTo("falso")==0)){
			Grafico.resultado.setText("Error Sintactico cerca del token "+token.Nombre+" en la Linea "+token.Linea);
		}else{
			Grafico.resultado.setText("Error Sintactico "+token.Nombre+" en la Linea "+token.Linea);
		}
			Merror=true;
		}
	}
	public static void errorSemantico(int tipoerror,Simbolos token){
		Ierror++;
		if(Ierror==1){ //Se queda con el primer error
			switch (tipoerror){
				case 1:
					Grafico.resultado.setText("Error Semantico cerca del token "+token.Nombre+" en la Linea "+token.Linea+", Token Duplicado.");				
					break;
				case 2:
					Grafico.resultado.setText("Error Semantico cerca del token "+token.Nombre+" en la Linea "+token.Linea+", Incompatibilidad con el Metodo.");				
					break;
				case 3:
					Grafico.resultado.setText("Error Semantico cerca del token "+token.Nombre+" en la Linea "+token.Linea+", No ha sido Declarada la variable.");				
					break;
				case 4:
					Grafico.resultado.setText("Error Semantico cerca del token "+token.Nombre+" en la Linea "+token.Linea+", Incompatibilidad de Variables.");				
					break;
				case 5:
					Grafico.resultado.setText("Error Semantico cerca del token "+token.Nombre+" en la Linea "+token.Linea+", No ha sido Declarada la clase.");				
					break;
				case 6:
					Grafico.resultado.setText("Error Semantico cerca del token "+token.Nombre+" en la Linea "+token.Linea+", La expresion no es valida en la clausula if.");				
					break;
			}			
			Merror=true;
		}
	}
	public static Vector<Simbolos> Duplicado(Vector<Simbolos> TablaSimbolos){
		for(int i=TablaSimbolos.size()-1;i>=0;i--){
			for(int j=0;j<TablaSimbolos.size();j++){
			  if(!(i==j))//se encuentra a si mismo y marca error
				if(TablaSimbolos.elementAt(i).Tipo.compareTo(TablaSimbolos.elementAt(j).Tipo)==0 && TablaSimbolos.elementAt(i).Nombre.compareTo(TablaSimbolos.elementAt(j).Nombre)==0){
					errorSemantico(1,TablaSimbolos.elementAt(i));
				}//Comprobando variables duplicadas
			}	
		}
		return TablaSimbolos;
	}
	public String CompararExpresiones(String ident1,String operador, String ident2){//tiene error
		Simbolos identificador1=null,identificador2=null;
		for(int i=0;i<TablaLocalesMetodo.size();i++){
			if(TablaLocalesMetodo.elementAt(i).Nombre.compareTo(ident1)==0)
				identificador1=TablaLocalesMetodo.elementAt(i);
			else
			if(TablaLocalesMetodo.elementAt(i).Nombre.compareTo(ident2)==0)
				identificador2=TablaLocalesMetodo.elementAt(i);				
		}
		if(operador.compareTo("+")==0 && identificador1.Tipo.compareTo("int")==0 && identificador2.Tipo.compareTo("int")==0)
			return "int";
			 else
		if(operador.compareTo("==")==0 && identificador1.Tipo.compareTo("int")==0 && identificador2.Tipo.compareTo("int")==0)
			return "boolean";
			 else
		if(operador.compareTo("==")==0 && identificador1.Tipo.compareTo("boolean")==0 && identificador2.Tipo.compareTo("boolean")==0)
			return "boolean";
		return "wrong";
	}
	public String TipoIdentificador(String ident){
		for(int i=0;i<TablaLocalesMetodo.size();i++){
			if(TablaLocalesMetodo.elementAt(i).Nombre.compareTo(ident)==0)
				return TablaLocalesMetodo.elementAt(i).Tipo;
		}		
		return "Error";
	}
	public boolean yaexiste(String idenf){
		for(int i=0;i<TablaLocalesMetodo.size();i++)
			if(TablaLocalesMetodo.elementAt(i).Nombre.compareTo(idenf)==0)
				return true;				
		return false;
	}
	public void ExisteExtend(){
		for(int i=0;i<extend.size();i++){
			boolean Encontrado=false;
			for(int j=0;j<TablaClases.size();j++){
				if(extend.elementAt(i).Nombre.compareTo(TablaClases.elementAt(j).Nombre)==0)
					Encontrado=true;
			}
			if(Encontrado==false)
			   errorSemantico(5,new Simbolos(extend.elementAt(i).Tipo,extend.elementAt(i).Nombre,extend.elementAt(i).Linea));			
		}	
	}
	public void program(){
		MainClass();
		if(token.Nombre.compareTo("class")==0)
		ClassDeclaration(); //puede que no venga class
		
		//Creando el arbol Sintactico
		 //for(int x=0;x<ArbolParsing.size();x++)
		 	// System.out.println(ArbolParsing.elementAt(x).Nombre);	
		// System.out.println("-----------------------------------------------------");
		 for(int x=0;x<ArbolParsing.size();x++){
			if(ArbolParsing.elementAt(x).Nombre.compareTo("System.out.println")==0 ||ArbolParsing.elementAt(x).Nombre.compareTo("true")==0
			||ArbolParsing.elementAt(x).Identificador.compareTo("Operador")==0 ||ArbolParsing.elementAt(x).Identificador.compareTo("Tipo")==0
			||ArbolParsing.elementAt(x).Identificador.compareTo("Identificador")==0||ArbolParsing.elementAt(x).Identificador.compareTo("Numerico")==0
			||ArbolParsing.elementAt(x).Nombre.compareTo("=")==0 || ArbolParsing.elementAt(x).Nombre.compareTo("if")==0)	
			ArbolSintactico.add(ArbolParsing.elementAt(x));	
		 }
		 
	//	 for(int i=0;i<ArbolSintactico.size();i++)
		//		System.out.println(ArbolSintactico.elementAt(i).Nombre);
		 
		 //tabla simbolos
		 /*System.out.println("Tabla de Clases");
		 for(int i=0;i<TablaClases.size();i++)
			 System.out.println(TablaClases.elementAt(i).Tipo+"   "+TablaClases.elementAt(i).Nombre+"   "+TablaClases.elementAt(i).Linea);
		 System.out.println("----------------------------------------------------------------------------------");
		 System.out.println("Tabla de Variables de Clase");
		 for(int i=0;i<TablaLocalesClase.size();i++)
			 System.out.println(TablaLocalesClase.elementAt(i).Tipo+"   "+TablaLocalesClase.elementAt(i).Nombre+"   "+TablaLocalesClase.elementAt(i).Linea);
		 System.out.println("----------------------------------------------------------------------------------"); 
		 System.out.println("Tabla de Metodos");
		 for(int i=0;i<TablaMetodos.size();i++)
			 System.out.println(TablaMetodos.elementAt(i).Tipo+"   "+TablaMetodos.elementAt(i).Nombre+"   "+TablaMetodos.elementAt(i).Linea);
		 System.out.println("----------------------------------------------------------------------------------");
		 System.out.println("Tabla de Parametros de Metodos");
		 for(int i=0;i<TablaParametros.size();i++)
			 System.out.println(TablaParametros.elementAt(i).Tipo+"   "+TablaParametros.elementAt(i).Nombre+"   "+TablaParametros.elementAt(i).Linea);
		 System.out.println("----------------------------------------------------------------------------------"); 
		 System.out.println("Tabla de Variables de Metodos");
		 for(int i=0;i<TablaLocalesMetodo.size();i++)
			 System.out.println(TablaLocalesMetodo.elementAt(i).Tipo+"   "+TablaLocalesMetodo.elementAt(i).Nombre+"   "+TablaLocalesMetodo.elementAt(i).Linea);
		 System.out.println("----------------------------------------------------------------------------------");
		 */
	}
	public void MainClass(){
	advance();
	if(!eat("class"))return; //si esta mal el eat termina el metodo mainclass
	advance();
	if(!EsIdentificador())error(token);
	TablaClases.add(new Simbolos("class",token.Nombre,token.Linea));
	JBC.Generar_ByteCodeMain(ArbolParsing, TablaClases);//Genera Bytecode
	advance();
	if(!eat("{"))return;
	advance();
	if(!eat("void"))return;
	advance();
	if(!eat("main"))return;
	TablaMetodos.add(new Simbolos("void",token.Nombre,token.Linea));
	advance();
	if(!eat("("))return;
	advance();
	if(!EsIdentificador()) error(token);
	advance();
	if(!eat(")"))return; 	//validar que siga statement
	if (temporal.NextToken().Nombre.compareTo("{")==0 || temporal.NextToken().Nombre.compareTo("if")==0 || temporal.NextToken().Nombre.compareTo("System.out.println")==0 || temporal.NextToken().Identificador.compareTo("Identificador")==0)	
		Statement(); 
	else{
		error(token);
		advance();
	}
	if(!eat("}"))return; //cierre de clase
	JBC.Generar_ByteCodeMain(ArbolParsing, TablaMetodos);//Genera Bytecode
	ArbolParsing.removeAllElements();//Limpia el arbol
	TablaMetodos.removeAllElements();//Limpia la tabla metodos
	advance(); //Comprobar si sobraron tokens
	if(Noexiste==true && Merror==false){ 
		Grafico.resultado.setText("Successfully Compiled!");
		return; 
		}//si ya no ahi mas token fue un exito
	else
		if(!(token.Nombre.compareTo("class")==0))
			error(token);
	}	
	public boolean EsStatement(scanner aux){
		if(aux.Nombre.compareTo("{")==0 || aux.Nombre.compareTo("if")==0 || aux.Nombre.compareTo("System.out.println")==0 || aux.Identificador.compareTo("Identificador")==0){
			adv++;
			return true;
		}			
		else
			return false; 
	}
	public void Statement(){
		if(adv==1)
			adv++;
		else
		advance();	
		if(Noexiste==true){ error(token); return; } 
		switch (token.Nombre) {
		case "{": eat("{"); 
			advance();
			if(Noexiste==true){ error(token); break; }
			switch(token.Nombre){
				case "{": eat("{"); Statement(); eat("}"); advance();  break;
				case "if":eat("if"); advance(); eat("("); expresionif(); eat(")"); Statement(); eat("else"); Statement();   break;
				case "System.out.println": eat("System.out.println"); advance(); eat("("); expresion(); eat(")"); advance(); eat(";"); Statement(); break;
				default: 	
					if(EsIdentificador()){
						String identify=token.Nombre;
						if(!yaexiste(token.Nombre))
							errorSemantico(3,new Simbolos(token.Identificador,token.Nombre,token.Linea)); 
						advance();
						eat("="); expresion(); 
						if(!TablaLocalesMetodo.isEmpty()){
							if(!(resultado.compareTo(TipoIdentificador(identify))==0)) 
								errorSemantico(4,new Simbolos(token.Identificador,token.Nombre,token.Linea));
						}
							eat(";"); Statement(); break;
					}else 	if(Noexiste==true){ error(token); break; }				 
			}  
		  if(Noexiste==true) break; //no existen mas tokens
		  eat("}"); advance();  break; 	
		case "if": eat("if"); advance(); eat("(");  expresionif();  eat(")"); Statement(); eat("else"); Statement();   break;
		case "System.out.println": eat("System.out.println"); advance(); eat("("); expresion();  eat(")"); advance(); eat(";"); Statement(); break;
		default:   
			if(EsIdentificador()){
				String identify=token.Nombre;
				if(!yaexiste(token.Nombre))
					errorSemantico(3,new Simbolos(token.Identificador,token.Nombre,token.Linea)); 	
			advance();
			eat("="); expresion(); 
			if(!TablaLocalesMetodo.isEmpty()){
				if(!(resultado.compareTo(TipoIdentificador(identify))==0)) 
					errorSemantico(4,new Simbolos(token.Identificador,token.Nombre,token.Linea));	
			}
				eat(";"); Statement(); break;
			}
			else
			if(Noexiste==true){ error(token); break; }
		}		
	}//Fin statement
	public void expresionMetodo(){
		String idenf1;
		advance();		
		if(EsIdentificador()){	
			idenf1=token.Nombre;
			if(!yaexiste(idenf1))
				errorSemantico(3,new Simbolos(token.Identificador,token.Nombre,token.Linea));
			advance();
			if((token.Identificador.compareTo("Operador")==0)){
				ArbolParsing.add(token);
				String operador=token.Nombre;
				advance();
				if(EsIdentificador()){
					String idenf2=token.Nombre;
					//Comparar metodo con return
				if(!yaexiste(idenf2))
					errorSemantico(3,new Simbolos(token.Identificador,token.Nombre,token.Linea));
				else{		
						resultado=CompararExpresiones(idenf1,operador,idenf2);
						if(resultado.compareTo("wrong")==0)
							errorSemantico(4,new Simbolos(token.Identificador,token.Nombre,token.Linea));
						else{	
					if(operador.compareTo("+")==0)
						if(TablaMetodos.elementAt(TablaMetodos.size()-1).Tipo.compareTo("int")==0)
							advance();
						else
							errorSemantico(2,new Simbolos(token.Identificador,token.Nombre,token.Linea));
					else
						if(operador.compareTo("==")==0)
							if(TablaMetodos.elementAt(TablaMetodos.size()-1).Tipo.compareTo("boolean")==0)
								advance();
							else
								errorSemantico(2,new Simbolos(token.Identificador,token.Nombre,token.Linea));
						}
				}
					return;	
				}  //validar que las variables ya hayan sido declaradas return variable;
			}else{
				if(!yaexiste(idenf1))
					errorSemantico(3,new Simbolos(token.Identificador,token.Nombre,token.Linea));
				else{
					resultado=TipoIdentificador(idenf1);
					if(resultado.compareTo("Error")==0)
						errorSemantico(4,new Simbolos(token.Identificador,token.Nombre,token.Linea));
					else{
				Simbolos identificador=null;
				for(int i=0;i<TablaLocalesMetodo.size();i++){
					if(TablaLocalesMetodo.elementAt(i).Nombre.compareTo(idenf1)==0)
						identificador=TablaLocalesMetodo.elementAt(i);						
				}				
				if(!(TablaMetodos.elementAt(TablaMetodos.size()-1).Tipo.compareTo(identificador.Tipo)==0))
					errorSemantico(2,new Simbolos(token.Identificador,token.Nombre,token.Linea));
					}
				}
				return;//como validar de que tipo es el identificador
			}
		}else
		  if(EsNumero(token.Nombre)){
			  resultado="int";
			  if(TablaMetodos.elementAt(TablaMetodos.size()-1).Tipo.compareTo("int")==0)
					advance();
				else
					errorSemantico(2,new Simbolos(token.Identificador,token.Nombre,token.Linea));
				return;
			}else
			  if(eat("true")){
				 resultado="boolean";
				  if(TablaMetodos.elementAt(TablaMetodos.size()-1).Tipo.compareTo("boolean")==0)
						advance();
					else
						errorSemantico(2,new Simbolos(token.Identificador,token.Nombre,token.Linea));
				return;
			}else
				error(token);	
	}
	public void expresion(){		
		advance();
		if(EsIdentificador()){
			String ident1=token.Nombre;
			if(!yaexiste(ident1))
				errorSemantico(3,new Simbolos(token.Identificador,token.Nombre,token.Linea));
			advance();
			if((token.Identificador.compareTo("Operador")==0)){
				ArbolParsing.add(token);
				String operador=token.Nombre;
				advance();
				if(EsIdentificador()){	
					if(!yaexiste(token.Nombre))
						errorSemantico(3,new Simbolos(token.Identificador,token.Nombre,token.Linea));
					String ident2=token.Nombre;	
					if(!TablaLocalesMetodo.isEmpty()){//checar que no este vacia
					resultado=CompararExpresiones(ident1,operador,ident2);
					if(resultado.compareTo("wrong")==0)
						errorSemantico(4,new Simbolos(token.Identificador,token.Nombre,token.Linea));
					}
					advance();
					return;	
				}
			}else{
				if(!yaexiste(ident1)) //checar aqui
					errorSemantico(3,new Simbolos(token.Identificador,token.Nombre,token.Linea)); 
				resultado=TipoIdentificador(ident1);
				if(!TablaLocalesMetodo.isEmpty()){
				if(resultado.compareTo("Error")==0)
					errorSemantico(4,new Simbolos(token.Identificador,token.Nombre,token.Linea));
				}
				return;
			}
		}else
		  if(EsNumero(token.Nombre)){
			  resultado="int";
				advance();
				return;
			}else
			  if(eat("true")){
				  resultado="boolean";
				advance();
				return;
			}else
				error(token); 
	}//Fin Expresion
	public void expresionif(){		
		advance();
		if(EsIdentificador()){
			String ident1=token.Nombre;
			if(!yaexiste(ident1))
				errorSemantico(3,new Simbolos(token.Identificador,token.Nombre,token.Linea));
			advance();
			if((token.Identificador.compareTo("Operador")==0)){
				ArbolParsing.add(token);
				String operador=token.Nombre;
				advance();
				if(EsIdentificador()){	
					if(!yaexiste(token.Nombre))
						errorSemantico(3,new Simbolos(token.Identificador,token.Nombre,token.Linea));
					String ident2=token.Nombre;	
					if(!TablaLocalesMetodo.isEmpty()){//checar que no este vacia
					resultado=CompararExpresiones(ident1,operador,ident2);
					if(resultado.compareTo("wrong")==0)
						errorSemantico(4,new Simbolos(token.Identificador,token.Nombre,token.Linea));
					}else
					 if(resultado.compareTo("int")==0)
						errorSemantico(6,new Simbolos(token.Identificador,token.Nombre,token.Linea));
					advance();
					return;	
				}
			}else{
				if(!yaexiste(ident1)) //checar aqui
					errorSemantico(3,new Simbolos(token.Identificador,token.Nombre,token.Linea)); 
				resultado=TipoIdentificador(ident1);
				if(resultado.compareTo("int")==0)
					errorSemantico(6,new Simbolos(token.Identificador,token.Nombre,token.Linea));
				if(!TablaLocalesMetodo.isEmpty()){
				if(resultado.compareTo("Error")==0)
					errorSemantico(4,new Simbolos(token.Identificador,token.Nombre,token.Linea));
				}
				return;
			}
		}else
		  if(EsNumero(token.Nombre)){
			  resultado="int";
				advance();//Comprobar errores sintacticos oh semanticos
				if(!(token.Nombre.compareTo(")")==0))
					error(token);
				else//no puede ir un solo numero en un if
					errorSemantico(6,new Simbolos(token.Identificador,token.Nombre,token.Linea));
				return;
			}else
			  if(eat("true")){
				  resultado="boolean";
				advance();
				return;
			}else
				error(token); 
	}//Fin Expresionif 
	public boolean Type(Vector<Simbolos> TablaSimbolos){
		advance();
		if((token.Identificador.compareTo("Tipo")==0)){ 
			ArbolParsing.add(token);
			TablaSimbolos.add(new Simbolos(token.Nombre,null,token.Linea));
			advance();
			return true;
		}
		else
			return false;			
	}
	public void VarDeclaration(Vector<Simbolos> TablaSimbolos){
		if(EsIdentificador()){ 
			//update
			TablaSimbolos.elementAt(TablaSimbolos.size()-1).setNombre(token.Nombre);
			advance(); if((token.Nombre.compareTo(";")==0)){  ArbolParsing.add(token);} else{ TablaSimbolos=Duplicado(TablaSimbolos);  return; } 
		}else{ error(token); return; }	
		if(Type(TablaSimbolos))
			VarDeclaration(TablaSimbolos);
		else{
			return;	//aqui termina tabla	
		}
	}
	public void parametros(){
		if(Type(TablaParametros)){
			 if(EsIdentificador()){
				 TablaParametros.elementAt(TablaParametros.size()-1).setNombre(token.Nombre);
				 advance();
				 if(token.Nombre.compareTo(",")==0){
					ArbolParsing.add(token);
					parametros();
				 }else {TablaParametros=Duplicado(TablaParametros);/* aqui eliminaba tabla parametros*/ }
			 }else{ error(token); return;  }
		} else{ error(token); return; }	 
	} //Fin Method
	public void ClassDeclaration(){
		if(!eat("class"))return; 
		advance();
		if(!EsIdentificador())error(token);
		TablaClases.add(new Simbolos("class",token.Nombre,token.Linea));
		JBC.Generar_ByteCodeMain(ArbolParsing, TablaClases);//Genera Bytecode
		advance();
		if(token.Nombre.compareTo("extends")==0){
			eat("extends");
			advance();
			if(!EsIdentificador())error(token);//Validar EXTENDS
				extend.add(new Simbolos(token.Identificador,token.Nombre,token.Linea));
				advance();
		}
		eat("{");
		if(Type(TablaLocalesClase)){
		   VarDeclaration(TablaLocalesClase); 
		   if(eat("(")) {
			   TablaMetodos.add(new Simbolos(TablaLocalesClase.elementAt(TablaLocalesClase.size()-1).Tipo,TablaLocalesClase.elementAt(TablaLocalesClase.size()-1).Nombre,TablaLocalesClase.elementAt(TablaLocalesClase.size()-1).Linea));	   
			   TablaLocalesClase.removeAllElements();
			   MethodDeclaration();
		   }else {error(token); }   
		} 
		eat("}");//cierra clase
		TablaMetodos=Duplicado(TablaMetodos);
		TablaMetodos.removeAllElements();
		advance(); //avanze necesario
		if(token.Nombre.compareTo("class")==0) 
			ClassDeclaration();
		else{
		TablaClases=Duplicado(TablaClases);
		ExisteExtend();	
		TablaClases.removeAllElements();
		if(Noexiste==true && Merror==false){//si ya no ahi mas token fue un exito
		Grafico.resultado.setText("Successfully Compiled!");
		return;
		}
		else
			error(token); 
		}
	}
	public void MethodDeclaration(){
		adv=0;
		 if(Type(TablaParametros)){//
			 if(EsIdentificador()){
				 TablaParametros.elementAt(TablaParametros.size()-1).setNombre(token.Nombre); 
				 advance();
				 if(token.Nombre.compareTo(",")==0){
					ArbolParsing.add(token);
					parametros();
				 }	
			 }else error(token); 
		 }
		eat(")");
		advance();
		eat("{"); //inicio metodo
		if(Type(TablaLocalesMetodo)) //sino es igual te lo avanza
			VarDeclaration(TablaLocalesMetodo);	 
		if(EsStatement(token))	
			Statement();
		eat("return");	
		expresionMetodo();
		eat(";");
		advance();
		eat("}");//<--- Final del Metodo
			JBC.Generar_ByteCode(ArbolParsing, TablaMetodos, TablaParametros,TablaLocalesMetodo);//Genera Bytecode
			ArbolParsing.removeAllElements();		
		TablaParametros.removeAllElements();//limpia tabla parametros
		TablaLocalesMetodo=Duplicado(TablaLocalesMetodo);//checa variables duplicadas
		TablaLocalesMetodo.removeAllElements();//limpia variables metodo
		if(Type(TablaLocalesClase)){
			   VarDeclaration(TablaLocalesClase); 
			   if(eat("(")){
				  TablaMetodos.add(new Simbolos(TablaLocalesClase.elementAt(TablaLocalesClase.size()-1).Tipo,TablaLocalesClase.elementAt(TablaLocalesClase.size()-1).Nombre,TablaLocalesClase.elementAt(TablaLocalesClase.size()-1).Linea));	   
				  TablaLocalesClase.removeAllElements();
				  MethodDeclaration();
			   }else {error(token); }   
			}		
	}
}//fin parser
