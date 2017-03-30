package Compilador;
import javax.swing.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.File;

public class Grafico extends JApplet{
	static JMenuBar barra=new JMenuBar();
	static JTextArea resultado,campo; 
	public void init(){
		setSize(750,550);
    }    
	scanner lexico=new scanner("a","b",0);
	Parser sintactico=new Parser();
	JavaByteCode BC= new JavaByteCode();;
	JButton boton;
	public Grafico()
	{	
		setLayout(null);
		//Texto
		  JLabel eti11= new JLabel( "                      B I E N V E N I D O  " );
		  eti11.setBounds(15,20,200,30);
		  add(eti11);
		  JLabel eti12= new JLabel( "*Seleccione una opción: " );
		  eti12.setBounds(15,35,150,50);
		  add(eti12);
		  JLabel eti1= new JLabel( "Abrir: " );
		  eti1.setBounds(15,75,100,30);
		  add(eti1);
		  JLabel eti2= new JLabel( "Compilar: " );
		  eti2.setBounds(15,125,100,15);
		  add(eti2);
		  //Datos Personales
		  JLabel eti3= new JLabel( "Autor: " );
		  eti3.setBounds(345,55,100,15);
		  add(eti3);
		  campo =new JTextArea();
		  campo.setEditable(false);
		  campo.setLineWrap(true);
		  campo.setWrapStyleWord(true);
		  JScrollPane ScrollP = new JScrollPane(campo);
		  ScrollP.setBounds(70,200,600,300);
		  add(ScrollP);
		  eti3.setBounds(345,55,100,15);
		  add(eti3);
		  JLabel eti4= new JLabel( "Félix Rosales Alexis Ramiro" );
		  eti4.setBounds(280,85,200,15);
		  add(eti4);
		  JLabel eti5= new JLabel( "Codigo Java ByteCode: " );
		  eti5.setBounds(300,160,150,15);
		  add(eti5);
		  JLabel eti6= new JLabel( "Resultado: " );
		  eti6.setBounds(550,20,150,15);
		  add(eti6);
		  resultado =new JTextArea();
		  resultado.setEditable(false);
		  resultado.setLineWrap(true);
		  resultado.setWrapStyleWord(true);
		  JScrollPane resultadoP = new JScrollPane(resultado);
		  resultadoP.setBounds(450,50,270,100);
		  add(resultadoP);
	  	  
	  	  boton=new JButton("COMPILAR");
		   boton.addActionListener(
			    	new ActionListener()
	    	         { 
	    	            public void actionPerformed( ActionEvent evento )
	    	            {  
	    	            	 if (!lexico.Invalido){//Le dice al programa si no ubo ningun token mal es true, todos los tokens	 
		    	        		 sintactico.program();//son correctos y entra al parser
	    	            	 if(!Parser.Merror)
			    	        	 campo.setText(BC.getByteCode());
		    	        	 else
		    	        		 campo.setText("No se pudo generar bytecode porque se encontraron errores!");
	    	            	 }
	    	            } // fin del método actionPerformed
	    	         } //Fin ActionListener
	    	      ); //Fin ActionListener ()
		   boton.setBounds(100,120,100,30);
		   boton.setEnabled(false);
		   add(boton);
	  	//Para separar la cadena token por token   
	   JButton botonAbrir=new JButton("ABRIR");
	   botonAbrir.addActionListener(
		    	new ActionListener()
 	         { 
 	            public void actionPerformed( ActionEvent evento )
 	            {  
	        	  	Abrir();
	        	  	boton.setEnabled(true);
 	            } // fin del método actionPerformed
 	         } //Fin ActionListener
 	      ); //Fin ActionListener ()
	   botonAbrir.setBounds(100,75,100,30);
	   add(botonAbrir);
	}
	public String Abrir(){
		  JFileChooser file=new JFileChooser();
	      file.showOpenDialog(this);
	      File texto=file.getSelectedFile(); 
	      
	      return lexico.scannerT(texto);
}
	
}
