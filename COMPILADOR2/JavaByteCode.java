package Compilador;
import java.util.Vector;

public class JavaByteCode {
	static String JavaByteCode="";
	String ByteCode="";
	int bytes=0,ultimo=0;
	public void Generar_ByteCode(Vector<scanner> arbol, Vector<Simbolos> metodos, Vector<Simbolos> parametros,Vector<Simbolos> locales){
		int j=0;
		if(metodos.elementAt(metodos.size()-1).Tipo.compareTo("int")==0 || metodos.elementAt(metodos.size()-1).Tipo.compareTo("boolean")==0){
			ByteCode="Method "+metodos.elementAt(metodos.size()-1).Tipo+"  "+metodos.elementAt(metodos.size()-1).Nombre+"(";
			for(int i=0;i<parametros.size();i++){
				ByteCode+=parametros.elementAt(i).Tipo+" "+parametros.elementAt(i).Nombre;
				if(i<parametros.size()-1)
					ByteCode+=", ";	
			}
			ByteCode+=");"+"\n";		
			for(int i=0;i<arbol.size();i++){
				String Stat=arbol.elementAt(i).Nombre;
			switch (Stat){
				case "System.out.println":
					j=i+2; //Compilar y checar
					scanner aux=arbol.elementAt(j);
					if(aux.Identificador.compareTo("Numerico")==0){
						ByteCode+=bytes+"\t getstatic #2 <java/lang/System.out:Ljava/io/PrintStream;\n";bytes+=3;
						ByteCode+=bytes+"\t"+" iconst_"+aux.Nombre+"\n"; bytes++;
						//ByteCode+=bytes+"\t"+" ldc #2 <Integer "+aux.Nombre+">\n";bytes+=2;
						ByteCode+=bytes+"\t invokevirtual #10 <Method java/io/PrintStream.println:(z)v>\n";bytes+=3;	
					}else//cargar variables para usarlas
					if(aux.Nombre.compareTo("true")==0){
						ByteCode+=bytes+"\t getstatic #2 <java/lang/System.out:Ljava/io/PrintStream;\n";bytes+=3;
						ByteCode+=bytes+"\t ldc #2 <Boolean "+aux.Nombre+">\n";bytes+=2;
						ByteCode+=bytes+"\t invokevirtual #10 <Method java/io/PrintStream.println:(z)v>\n";bytes+=3;
					}else
					if(aux.Identificador.compareTo("Identificador")==0){
						String ident1,ident2;
						ident1=aux.Nombre;
						j++;
						aux=arbol.elementAt(j);
						if(aux.Nombre.compareTo("+")==0){
							j++;
							aux=arbol.elementAt(j);
							if(aux.Identificador.compareTo("Identificador")==0){
								ident2=aux.Nombre;
								//todo listo para el bytecode
								ByteCode+=bytes+"\t getstatic #2 <java/lang/System.out:Ljava/io/PrintStream;\n";bytes+=3;
								ByteCode+=bytes+"\t iload_"+BuscarPosicion(ident1,parametros,locales)+"\n";bytes++;
								ByteCode+=bytes+"\t iload_"+BuscarPosicion(ident2,parametros,locales)+"\n";bytes++;
								ByteCode+=bytes+"\t iadd\n";bytes++;
								ByteCode+=bytes+"\t ldc #2 <Integer "+ident1+"+"+ident2+">\n";bytes+=2;
								ByteCode+=bytes+"\t invokevirtual #10 <Method java/io/PrintStream.println:(z)v>\n";bytes+=3;	
							}
						}else
						if(aux.Nombre.compareTo("==")==0){
							j++;
							aux=arbol.elementAt(j);
							if(aux.Identificador.compareTo("Identificador")==0){
								ident2=aux.Nombre;
								//todo listo para el bytecode
								ByteCode+=bytes+"\t getstatic #2 <java/lang/System.out:Ljava/io/PrintStream;\n";bytes+=3;
								ByteCode+=bytes+"\t iload_"+BuscarPosicion(ident1,parametros,locales)+"\n";bytes++;
								ByteCode+=bytes+"\t iload_"+BuscarPosicion(ident2,parametros,locales)+"\n";bytes++;
								ByteCode+=bytes+"\t if_icmpe\n";bytes+=3;
								ByteCode+=bytes+"\t ldc #2 < String "+ident1+"=="+ident2+">\n";bytes+=2;
								ByteCode+=bytes+"\t InvokeVirtual #10 <Method void println(Java.lang.String)>\n";bytes+=3;
							}		
						}else{//solo fue un identificador
							j+=-1;
							aux=arbol.elementAt(j);
							ByteCode+=bytes+"\t getstatic #2 <java/lang/System.out:Ljava/io/PrintStream;\n";bytes+=3;
							ByteCode+=bytes+"\t iload_"+BuscarPosicion(aux.Nombre,parametros,locales)+"\n";bytes++;
							ByteCode+=bytes+"\t ldc #2 <String "+aux.Nombre+">\n";bytes+=2;
							ByteCode+=bytes+"\t InvokeVirtual #10 <Method void println(Java.lang.String)>\n";bytes+=3;		
						}	
					}		
					break;
				case "if":
					j=i+3;
					if(arbol.elementAt(j).Nombre.compareTo("==")==0){
					j--;	
					ByteCode+=bytes+"\t iload_"+BuscarPosicion(arbol.elementAt(j).Nombre,parametros,locales)+"\n";bytes++;
					j+=2;
					ByteCode+=bytes+"\t iload_"+BuscarPosicion(arbol.elementAt(j).Nombre,parametros,locales)+"\n";bytes++;
					//if
					int bit=bytes+3;
					String codigo[]=Codigo(arbol,parametros,locales,i+1,bit);
					ByteCode+=bytes+"\t if_icmpne "+codigo[1]+"\n";
					ByteCode+=codigo[0];
					bytes=Integer.parseInt(codigo[1]);
					bytes+=3;
					i=Integer.parseInt(codigo[2]);
					
					}else
						if(arbol.elementAt(j).Nombre.compareTo("true")==0){
							ByteCode+=bytes+"\t iconst_1"+"\n";bytes++;
							ByteCode+=bytes+"\t if_icmpe\n";bytes+=3;
						}
					break;
				case "=":
					String ident,ident1,ident2;
					j=i-1;
					aux=arbol.elementAt(j);
					ident=aux.Nombre;
					j+=2;
					aux=arbol.elementAt(j);
					if(aux.Identificador.compareTo("Identificador")==0){
					ident1=arbol.elementAt(j).Nombre;
					j++;
					aux=arbol.elementAt(j);
					if(aux.Nombre.compareTo("+")==0){
						j++;
						aux=arbol.elementAt(j);
						if(aux.Identificador.compareTo("Identificador")==0){
							ident2=aux.Nombre;
							//todo listo para el bytecode
							ByteCode+=bytes+"\t iload_"+BuscarPosicion(ident1,parametros,locales)+"\n";bytes++;
							ByteCode+=bytes+"\t iload_"+BuscarPosicion(ident2,parametros,locales)+"\n";bytes++;
							ByteCode+=bytes+"\t iadd\n";bytes++;
							ByteCode+=bytes+"\t istore_"+BuscarPosicion(ident,parametros,locales)+"\n";bytes++;
							
						}
					}else
					if(aux.Nombre.compareTo("==")==0){
						j++;
						aux=arbol.elementAt(j);
						if(aux.Identificador.compareTo("Identificador")==0){
							ident2=aux.Nombre;
							//todo listo para el bytecode
							ByteCode+=bytes+"\t iload_"+BuscarPosicion(ident1,parametros,locales)+"\n";bytes++;
							ByteCode+=bytes+"\t iload_"+BuscarPosicion(ident2,parametros,locales)+"\n";bytes++;
							ByteCode+=bytes+"\t ifcmpe\n";bytes+=3;
							ByteCode+=bytes+"\t istore_"+BuscarPosicion(ident,parametros,locales)+"\n";bytes++;
						}		
					}else{//solo fue un identificador
						j+=-1;
						aux=arbol.elementAt(j);
						ByteCode+=bytes+"\t iload_"+BuscarPosicion(aux.Nombre,parametros,locales)+"\n";bytes++;		
						ByteCode+=bytes+"\t istore_"+BuscarPosicion(ident,parametros,locales)+"\n";bytes++;	
					}	
					}else
						if(arbol.elementAt(j).Identificador.compareTo("Numerico")==0){
						ByteCode+=bytes+"\t iconst_"+arbol.elementAt(j).Nombre+"\n";bytes++;
						ByteCode+=bytes+"\t istore_"+BuscarPosicion(ident,parametros,locales)+"\n";bytes++;			
					}
					if(arbol.elementAt(j).Nombre.compareTo("true")==0){
						ByteCode+=bytes+"\t iconst_1"+"\n";bytes++;
						ByteCode+=bytes+"\t istore_"+BuscarPosicion(ident,parametros,locales)+"\n";bytes++;			
					}
					break;
				case "return":
					j=i+1;
					if(arbol.elementAt(j).Identificador.compareTo("Identificador")==0){//checar
						ByteCode+=bytes+"\t iload_"+BuscarPosicion(arbol.elementAt(j).Nombre,parametros,locales)+"\n";bytes++;
						j+=2;
						if(arbol.elementAt(j).Identificador.compareTo("Identificador")==0){//checar
							ByteCode+=bytes+"\t iload_"+BuscarPosicion(arbol.elementAt(j).Nombre,parametros,locales)+"\n";bytes++;
						j--;
						if(arbol.elementAt(j).Nombre.compareTo("==")==0){//checar
							ByteCode+=bytes+"\t if_icmpe\n";bytes+=3;
							ByteCode+=bytes+"\t iconst_1"+"\n";bytes++;
						}else{
							ByteCode+=bytes+"\t iadd\n";bytes++;
						}
					  }
					}else
					if(arbol.elementAt(j).Identificador.compareTo("Numerico")==0){
						ByteCode+=bytes+"\t iconst_"+arbol.elementAt(j).Nombre+"\n";bytes++;	
					}else
					if(arbol.elementAt(j).Nombre.compareTo("true")==0){
						ByteCode+=bytes+"\t iconst_1"+"\n";bytes++;
					}
					break;
				case "else":
					//ByteCode+=bytes+"\t if_icmpe "+bytes+"\n";bytes+=3;
					//ByteCode+=bytes+"\t goto "+"\n";bytes+=3;
					break;
				default:
					break;
				}//cierre switch
			  }//cierre for
			}//cierre if
		ByteCode+=bytes+"\t ireturn\n"; 
		bytes=0;
		System.out.println(ByteCode);
		System.out.println("------------------------------------------------------------------");
		JavaByteCode+=ByteCode;	
	}
	public void Generar_ByteCodeMain(Vector<scanner> arbol, Vector<Simbolos> TablaSimbolos){
		int j=0;
		String parametro="";
		if(TablaSimbolos.elementAt(TablaSimbolos.size()-1).Tipo.compareTo("class")==0){
		ByteCode="Method "+TablaSimbolos.elementAt(TablaSimbolos.size()-1).Nombre+"();"+"\n";
		ByteCode+= bytes+"\t aload_0\n"+(++bytes)+"\t invokespecial #1\n\t<Method java/lang/Object.\"<init>\":()>\n";
		bytes+=3;
		}else
		if(TablaSimbolos.elementAt(TablaSimbolos.size()-1).Tipo.compareTo("void")==0){
			int cont=0;
			for(int i=0;i<arbol.size();i++){
				if(arbol.elementAt(i).Identificador.compareTo("Identificador")==0){
					if(cont==1){
					parametro=arbol.elementAt(i).Nombre;
					break;
					}
					cont++;
				}
			}
			ByteCode="Method "+TablaSimbolos.elementAt(TablaSimbolos.size()-1).Tipo+"  "+TablaSimbolos.elementAt(TablaSimbolos.size()-1).Nombre+"("+"Object "+parametro+")"+"\n";
		for(int i=0;i<arbol.size();i++){
			String Stat=arbol.elementAt(i).Nombre;
			switch (Stat){
				case "System.out.println":
					j=i+2; //Compilar y checar
					scanner aux=arbol.elementAt(j);
					if(aux.Identificador.compareTo("Numerico")==0){
						
						ByteCode+=bytes+"\t getstatic #2 <java/lang/System.out:Ljava/io/PrintStream;\n";bytes+=3;
						ByteCode+=bytes+"\t"+" iconst_"+aux.Nombre+"\n"; bytes++;
						ByteCode+=bytes+"\t invokevirtual #10 <Method java/io/PrintStream.println:(z)v>\n";bytes+=3;
						
					}else
					if(aux.Nombre.compareTo("true")==0){
						ByteCode+=bytes+"\t getstatic #2 <java/lang/System.out:Ljava/io/PrintStream;\n";bytes+=3;
						ByteCode+=bytes+"\t ldc #2 <Boolean "+aux.Nombre+">\n";bytes+=2;
						ByteCode+=bytes+"\t invokevirtual #10 <Method java/io/PrintStream.println:(z)v>\n";bytes+=3;
					}		
					break;
				case "if":
					int salto=0;
					ByteCode+=bytes+"\t iconst_1"+"\n";bytes++;
					salto=(salto+bytes+3);
					ByteCode+=bytes+"\t if_icmpe "+salto+"\n";bytes+=3;
					break;
			/*	case "else":
					ByteCode+=bytes+"\t goto "+"\n";bytes+=3;
					break;*/
				}//cierre swtich
			}//cierre for
		}//cierre if 
		ByteCode+=bytes+"\t ireturn\n"; 
		bytes=0;
		System.out.println(ByteCode);
		System.out.println("------------------------------------------------------------------");
		JavaByteCode+=ByteCode;	
	}
	public int BuscarPosicion(String token, Vector<Simbolos> parametros, Vector<Simbolos> locales){
		int pos=-1;
		for(int i=0;i<parametros.size();i++){
			if(token.compareTo(parametros.elementAt(i).Nombre)==0){
				pos=i;
				return pos;
			}
		}
		for(int i=0;i<locales.size();i++){
			if(token.compareTo(locales.elementAt(i).Nombre)==0){
				pos=i;
				return pos+parametros.size();
			}
		}
		return pos;
	}
	public String getByteCode(){
		return JavaByteCode;
	}
	public String[] Codigo(Vector<scanner> arbol, Vector<Simbolos> parametros,Vector<Simbolos> locales,int h,int bytes){
		int j=0;
		String codigo="";
		String datos[] = new String [5];
		for(int i=h;i<arbol.size();i++){
			String Stat=arbol.elementAt(i).Nombre;
		switch (Stat){
			case "System.out.println":
				j=i+2; //Compilar y checar
				scanner aux=arbol.elementAt(j);
				if(aux.Identificador.compareTo("Numerico")==0){
					codigo+=bytes+"\t getstatic #2 <java/lang/System.out:Ljava/io/PrintStream;\n";bytes+=3;
					codigo+=bytes+"\t"+" iconst_"+aux.Nombre+"\n"; bytes++;
					codigo+=bytes+"\t invokevirtual #10 <Method java/io/PrintStream.println:(z)v>\n";bytes+=3;	
				}else//cargar variables para usarlas
				if(aux.Nombre.compareTo("true")==0){
					codigo+=bytes+"\t getstatic #2 <java/lang/System.out:Ljava/io/PrintStream;\n";bytes+=3;
					codigo+=bytes+"\t ldc #2 <Boolean "+aux.Nombre+">\n";bytes+=2;
					codigo+=bytes+"\t invokevirtual #10 <Method java/io/PrintStream.println:(z)v>\n";bytes+=3;
				}else
				if(aux.Identificador.compareTo("Identificador")==0){
					String ident1,ident2;
					ident1=aux.Nombre;
					j++;
					aux=arbol.elementAt(j);
					if(aux.Nombre.compareTo("+")==0){
						j++;
						aux=arbol.elementAt(j);
						if(aux.Identificador.compareTo("Identificador")==0){
							ident2=aux.Nombre;
							//todo listo para el codigo
							codigo+=bytes+"\t getstatic #2 <java/lang/System.out:Ljava/io/PrintStream;\n";bytes+=3;
							codigo+=bytes+"\t iload_"+BuscarPosicion(ident1,parametros,locales)+"\n";bytes++;
							codigo+=bytes+"\t iload_"+BuscarPosicion(ident2,parametros,locales)+"\n";bytes++;
							codigo+=bytes+"\t iadd\n";bytes++;
							codigo+=bytes+"\t ldc #2 <Integer "+ident1+"+"+ident2+">\n";bytes+=2;
							codigo+=bytes+"\t invokevirtual #10 <Method java/io/PrintStream.println:(z)v>\n";bytes+=3;	
						}
					}else
					if(aux.Nombre.compareTo("==")==0){
						j++;
						aux=arbol.elementAt(j);
						if(aux.Identificador.compareTo("Identificador")==0){
							ident2=aux.Nombre;
							//todo listo para el codigo
							codigo+=bytes+"\t getstatic #2 <java/lang/System.out:Ljava/io/PrintStream;\n";bytes+=3;
							codigo+=bytes+"\t iload_"+BuscarPosicion(ident1,parametros,locales)+"\n";bytes++;
							codigo+=bytes+"\t iload_"+BuscarPosicion(ident2,parametros,locales)+"\n";bytes++;
							codigo+=bytes+"\t if_icmpe\n";bytes+=3;
							codigo+=bytes+"\t ldc #2 < String "+ident1+"=="+ident2+">\n";bytes+=2;
							codigo+=bytes+"\t InvokeVirtual #10 <Method void println(Java.lang.String)>\n";bytes+=3;
						}		
					}else{//solo fue un identificador
						j+=-1;
						aux=arbol.elementAt(j);
						codigo+=bytes+"\t getstatic #2 <java/lang/System.out:Ljava/io/PrintStream;\n";bytes+=3;
						codigo+=bytes+"\t iload_"+BuscarPosicion(aux.Nombre,parametros,locales)+"\n";bytes++;
						codigo+=bytes+"\t ldc #2 <String "+aux.Nombre+">\n";bytes+=2;
						codigo+=bytes+"\t InvokeVirtual #10 <Method void println(Java.lang.String)>\n";bytes+=3;		
					}	
				}		
				break;
			case "if":
				j=i+3;
				if(arbol.elementAt(j).Nombre.compareTo("==")==0){
				j--;	
				ByteCode+=bytes+"\t iload_"+BuscarPosicion(arbol.elementAt(j).Nombre,parametros,locales)+"\n";bytes++;
				j+=2;
				ByteCode+=bytes+"\t iload_"+BuscarPosicion(arbol.elementAt(j).Nombre,parametros,locales)+"\n";bytes++;
				//if
				int bit=bytes+3;
				String codigo2[]=Codigo(arbol,parametros,locales,i+1,bit);
				ByteCode+=bytes+"\t if_icmpne "+codigo2[1]+"\n";
				ByteCode+=codigo2[0];
				bytes=Integer.parseInt(codigo2[1]);
				bytes+=3;
				i=Integer.parseInt(codigo2[2]);
				
				}else
					if(arbol.elementAt(j).Nombre.compareTo("true")==0){
						ByteCode+=bytes+"\t iconst_1"+"\n";bytes++;
						ByteCode+=bytes+"\t if_icmpe\n";bytes+=3;
					}
				break;
			case "=":
				String ident,ident1,ident2;
				j=i-1;
				aux=arbol.elementAt(j);
				ident=aux.Nombre;
				j+=2;
				aux=arbol.elementAt(j);
				if(aux.Identificador.compareTo("Identificador")==0){
				ident1=arbol.elementAt(j).Nombre;
				j++;
				aux=arbol.elementAt(j);
				if(aux.Nombre.compareTo("+")==0){
					j++;
					aux=arbol.elementAt(j);
					if(aux.Identificador.compareTo("Identificador")==0){
						ident2=aux.Nombre;
						//todo listo para el codigo
						codigo+=bytes+"\t iload_"+BuscarPosicion(ident1,parametros,locales)+"\n";bytes++;
						codigo+=bytes+"\t iload_"+BuscarPosicion(ident2,parametros,locales)+"\n";bytes++;
						codigo+=bytes+"\t iadd\n";bytes++;
						codigo+=bytes+"\t istore_"+BuscarPosicion(ident,parametros,locales)+"\n";bytes++;
						
					}
				}else
				if(aux.Nombre.compareTo("==")==0){
					j++;
					aux=arbol.elementAt(j);
					if(aux.Identificador.compareTo("Identificador")==0){
						ident2=aux.Nombre;
						//todo listo para el codigo
						codigo+=bytes+"\t iload_"+BuscarPosicion(ident1,parametros,locales)+"\n";bytes++;
						codigo+=bytes+"\t iload_"+BuscarPosicion(ident2,parametros,locales)+"\n";bytes++;
						codigo+=bytes+"\t ifcmpe\n";bytes+=3;
						codigo+=bytes+"\t istore_"+BuscarPosicion(ident,parametros,locales)+"\n";bytes++;
					}		
				}else{//solo fue un identificador
					j+=-1;
					aux=arbol.elementAt(j);
					codigo+=bytes+"\t iload_"+BuscarPosicion(aux.Nombre,parametros,locales)+"\n";bytes++;		
					codigo+=bytes+"\t istore_"+BuscarPosicion(ident,parametros,locales)+"\n";bytes++;	
				}	
				}else
					if(arbol.elementAt(j).Identificador.compareTo("Numerico")==0){
					codigo+=bytes+"\t iconst_"+arbol.elementAt(j).Nombre+"\n";bytes++;
					codigo+=bytes+"\t istore_"+BuscarPosicion(ident,parametros,locales)+"\n";bytes++;			
				}
				if(arbol.elementAt(j).Nombre.compareTo("true")==0){
					codigo+=bytes+"\t iconst_1"+"\n";bytes++;
					codigo+=bytes+"\t istore_"+BuscarPosicion(ident,parametros,locales)+"\n";bytes++;			
				}
				break;
			case "return":
				j=i+1;
				if(arbol.elementAt(j).Identificador.compareTo("Identificador")==0){//checar
					codigo+=bytes+"\t iload_"+BuscarPosicion(arbol.elementAt(j).Nombre,parametros,locales)+"\n";bytes++;
					j+=2;
					if(arbol.elementAt(j).Identificador.compareTo("Identificador")==0){//checar
						codigo+=bytes+"\t iload_"+BuscarPosicion(arbol.elementAt(j).Nombre,parametros,locales)+"\n";bytes++;
					j--;
					if(arbol.elementAt(j).Nombre.compareTo("==")==0){//checar
						codigo+=bytes+"\t if_icmpe\n";bytes+=3;
						codigo+=bytes+"\t iconst_1"+"\n";bytes++;
					}else{
						codigo+=bytes+"\t iadd\n";bytes++;
					}
				  }
				}else
				if(arbol.elementAt(j).Identificador.compareTo("Numerico")==0){
					codigo+=bytes+"\t iconst_"+arbol.elementAt(j).Nombre+"\n";bytes++;	
				}else
				if(arbol.elementAt(j).Nombre.compareTo("true")==0){
					codigo+=bytes+"\t iconst_1"+"\n";bytes++;
				}
				break;
			case "else":
				datos[0]=codigo;
				datos[1]=(bytes-3)+"";
				datos[2]=i+"";
				
				return datos;
			default:
				break;
			}//cierre switch
		  }//cierre for
		return datos;
	}
}
