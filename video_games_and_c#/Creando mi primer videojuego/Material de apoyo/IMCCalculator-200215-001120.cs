using System.Collections;
using System.Collections.Generic;
using UnityEngine;
/// <summary>
/// RETO: Calculadora IMC.
/// </summary>
public class IMCCalculator : MonoBehaviour {
    /// Estatura en metros.
    public float altura;
    /// Peso en KG
    public float peso;
    ///Resultado
    public float imc;
    /// <summary>
    /// Start Function.
    /// </summary>
    void Start()
    {
        imc = peso / (altura * altura);
        Debug.Log("Tu IMC es de: " + imc);
        /// Condiciones
        if (imc > 30 ) {
            Debug.Log("Padeces de obesidad\n");
        }
        else if (imc > 25 && imc < 30) {
            Debug.Log("Padeces de sobrepeso.");
        }
        else if (imc > 20 && imc < 25) {
            Debug.Log("Tienes un peso saludable");
        }
        else if (imc > 5 && imc < 20) {
            Debug.Log("Estás delgado.");
        }
    }
}