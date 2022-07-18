/*  Conversion pour un entier (type int)
    de base décimale    (b=10)
    à base heptale      (b=7)
    */

class Heptal{
    static String h(int x){
        // pour obtenir la décomposition, on utilise: 7*(x/7)_7 + x%7
        if(x<=0) return "";    /* la chaîne vide */
        return  h(x/7) + x%7; /* concaténation (symbole +)
                               * de la décomposition de x/7 (quotient de x dans la division entière par 7)
                               * et du chhiffre des unités x%7 (x modulo 7)*/
    }
    public static void main(String[] args) {
        int t=1789;
        System.out.println("("+t+")_{10}=("+h(t)+")_{7}");
        t=2020;
        System.out.println("("+t+")_{10}=("+h(t)+")_{7}");
	}
}
