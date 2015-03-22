from random import choice
import string, sys

dictionary = set(open('words.txt','r').read().lower().split())
max_len = max(map(len, dictionary)) #longest word in the set of words

#text = ''.join([choice(string.ascii_lowercase) for i in xrange(28000)])
text = sys.argv[1];
#print text;
def extract(text):
   words_found = [] #set of words found, starts empty
   for i in xrange(len(text)): #for each possible starting position in the corpus
       chunk = text[i:i+max_len+1] #chunk that is the size of the longest word
       for j in xrange(1,len(chunk)+1): #loop to check each possible subchunk
           word = chunk[:j] #subchunk
           if word in dictionary: #constant time hash lookup if it's in dictionary
               if len(word) > 3:
                  words_found.append(word) #add to set of words
   #return words_found
   words_found_hueristic = [];
   for word in  words_found:
      for x in words_found:
         inlist = False
         for huer in words_found_hueristic:
            if word in huer:
               inlist = True        
         if inlist == False:
            words_found_hueristic.append(word)
         words_found_hueristic = checkRepititions(words_found_hueristic)
   return words_found_hueristic

#refractured function for words_found
'''
def createList(array):
   for word in array:
      for subword in array:
         inlist = False
         for huer in words_found_hueristic
'''

#checks if there are repitious words in array ie: attract, attractions
def checkRepititions(array):
   for word in array:
      for subword in array:
         if subword in word and subword != word:
            array.remove(subword)
   return array

words_found = extract(text)
print words_found
for x in words_found:
   print x;
