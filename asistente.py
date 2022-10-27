
import re
import speech_recognition as sr
import pyttsx3
import pywhatkit
import datetime


name = 'siri'

#crear variable para que reconozca la voz
listener = sr.Recognizer()

engine = pyttsx3.init()

voices = engine.getProperty('voices')
engine.setProperty('voice', voices[0].id)


def talk(text):   
    engine.say(text)
    engine.runAndWait()

#crear bloque
def listen():
    try:
         with sr.Microphone() as source:
              print("Escuchando......")
              voice = listener.listen(source)
              rec = listener.recognize_google(voice)
              rec = rec.lower()
              if name in rec:
                rec = rec.replace(name, '')
                print(rec)
                    
    except:
        pass
    return rec

#reproducir musica
def run():
    rec = listen()
    if 'reproduce' in rec:
        music = rec.replace('reproduce', '')
        talk('Reproduciendo' + music)
        pywhatkit.playonyt(music)
    elif 'hola' in rec:
        hora = datetime.datetime.now().strftime('%I:%M %p')
        talk("Son las " + hora)
    else:
        talk("Aprende a hablar culero vuelve a intentarlo")
    
run()



