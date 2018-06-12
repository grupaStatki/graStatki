joinWaitingRoom - dodaje ID gracza do pokoju oczekiwania  
leaveWaitingRoom - gracz jest usuwany z pokoju oczekiwania przy wyjściu ze strony  
insertAndUpdate - zapisuje tablice gracza w postaci stringa, pola oddzielone przecinkami  
gameRoomUpdater - łączy przeciwników w pary i ustawia kto ma zacząć rozgrywkę, powinien usuwać z pokoju oczekiwania,  
bo przy więcej niż jednej parze przeciwników skrypt nie zadziała (wystarczy obsługa jednej pary klientów, więc nie ma na to czasu)  
  
SETUP:  
-statkiSerwer przenieść do głównego htdocs  
-uruchomić createDatabase jeżeli nie ma tabel w bazie danych  
